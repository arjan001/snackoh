<?php
include_once "./includes/session_check.php";
include_once "./includes/header.php";
include_once "./includes/sidebar.php";
?>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">POS Session Management</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">POS Sessions</li>
                    </ul>
                </div>
                <div class="col-auto text-end float-end ms-auto">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#openSessionModal">
                        <i data-feather="plus-circle" class="me-2"></i>Open New Session
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Current Session Status</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        // Check for active session
                        $employee_id = $_SESSION['employee_id'] ?? 0;
                        $active_session_query = "SELECT * FROM pos_sessions WHERE employee_id = ? AND status = 'open' ORDER BY opening_time DESC LIMIT 1";
                        $stmt = $conn->prepare($active_session_query);
                        $stmt->bind_param("i", $employee_id);
                        $stmt->execute();
                        $active_session = $stmt->get_result()->fetch_assoc();
                        $stmt->close();

                        if ($active_session) {
                            // Calculate session duration
                            $opening_time = new DateTime($active_session['opening_time']);
                            $now = new DateTime();
                            $duration = $now->diff($opening_time);
                            $hours_open = $duration->h + ($duration->days * 24);
                            
                            // Calculate current sales
                            $sales_query = "SELECT SUM(total_price) as total_sales, COUNT(*) as total_transactions 
                                           FROM orders 
                                           WHERE created_at >= ? AND created_at <= NOW()";
                            $stmt = $conn->prepare($sales_query);
                            $stmt->bind_param("s", $active_session['opening_time']);
                            $stmt->execute();
                            $sales_result = $stmt->get_result();
                            $sales_data = $sales_result->fetch_assoc();
                            $stmt->close();
                            
                            $current_sales = $sales_data['total_sales'] ?? 0;
                            $current_transactions = $sales_data['total_transactions'] ?? 0;
                            
                            // Determine alert class based on session duration
                            $alert_class = 'alert-success';
                            $duration_warning = '';
                            if ($hours_open >= 6) {
                                $alert_class = 'alert-danger';
                                $duration_warning = '<div class="alert alert-danger mt-2">
                                    <i data-feather="alert-triangle" class="feather-16 me-2"></i>
                                    <strong>Warning:</strong> This session has been open for ' . $hours_open . ' hours. Please close it soon!
                                </div>';
                            } elseif ($hours_open >= 5) {
                                $alert_class = 'alert-warning';
                                $duration_warning = '<div class="alert alert-warning mt-2">
                                    <i data-feather="clock" class="feather-16 me-2"></i>
                                    <strong>Reminder:</strong> This session has been open for ' . $hours_open . ' hours. Consider closing it.
                                </div>';
                            }
                            
                            echo "<div class='$alert_class'>
                                    <h5><i data-feather='check-circle' class='feather-16 me-2'></i>Active Session</h5>
                                    <p><strong>Session ID:</strong> {$active_session['session_id']}</p>
                                    <p><strong>Opening Amount:</strong> KSH " . number_format($active_session['opening_amount'], 2) . "</p>
                                    <p><strong>Opening Time:</strong> " . date('M d, Y H:i', strtotime($active_session['opening_time'])) . "</p>
                                    <p><strong>Session Duration:</strong> {$duration->h}h {$duration->i}m</p>
                                    <p><strong>Current Sales:</strong> KSH " . number_format($current_sales, 2) . "</p>
                                    <p><strong>Current Transactions:</strong> {$current_transactions}</p>
                                    <a href='#' class='btn btn-warning close-session-btn' data-bs-toggle='modal' data-bs-target='#closeSessionModal' 
                                       data-session-id='{$active_session['session_id']}' 
                                       data-opening-amount='{$active_session['opening_amount']}' 
                                       data-current-sales='{$current_sales}'>
                                        <i data-feather='lock' class='me-2'></i>Close Session
                                    </a>
                                  </div>";
                            echo $duration_warning;
                        } else {
                            echo "<div class='alert alert-warning'>
                                    <h5><i data-feather='alert-triangle' class='feather-16 me-2'></i>No Active Session</h5>
                                    <p>You need to open a POS session before making sales.</p>
                                    <a href='#' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#openSessionModal'>
                                        <i data-feather='unlock' class='me-2'></i>Open Session
                                    </a>
                                  </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Recent Sessions</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Session ID</th>
                                        <th>Opening Amount</th>
                                        <th>Closing Amount</th>
                                        <th>Total Sales</th>
                                        <th>Transactions</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sessions_query = "SELECT * FROM pos_sessions WHERE employee_id = ? ORDER BY opening_time DESC LIMIT 10";
                                    $stmt = $conn->prepare($sessions_query);
                                    $stmt->bind_param("i", $employee_id);
                                    $stmt->execute();
                                    $sessions = $stmt->get_result();
                                    $stmt->close();

                                    while ($session = $sessions->fetch_assoc()) {
                                        $status_class = $session['status'] === 'open' ? 'badge bg-success' : 'badge bg-secondary';
                                        
                                        // Calculate duration
                                        $opening_time = new DateTime($session['opening_time']);
                                        $closing_time = $session['closing_time'] ? new DateTime($session['closing_time']) : new DateTime();
                                        $duration = $closing_time->diff($opening_time);
                                        $duration_text = $session['status'] === 'open' ? 
                                            "{$duration->h}h {$duration->i}m (ongoing)" : 
                                            "{$duration->h}h {$duration->i}m";
                                        
                                        echo "<tr>
                                                <td>{$session['session_id']}</td>
                                                <td>KSH " . number_format($session['opening_amount'], 2) . "</td>
                                                <td>KSH " . number_format($session['closing_amount'], 2) . "</td>
                                                <td>KSH " . number_format($session['total_sales'], 2) . "</td>
                                                <td>{$session['total_transactions']}</td>
                                                <td>{$duration_text}</td>
                                                <td><span class='$status_class'>{$session['status']}</span></td>
                                                <td>" . date('M d, Y H:i', strtotime($session['opening_time'])) . "</td>
                                              </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Open Session Modal -->
<div class="modal fade" id="openSessionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Open POS Session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="openSessionForm" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="openingAmount" class="form-label">Opening Amount (KSH)</label>
                        <input type="number" class="form-control" id="openingAmount" name="opening_amount" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="sessionNotes" class="form-label">Notes (Optional)</label>
                        <textarea class="form-control" id="sessionNotes" name="notes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Open Session</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Close Session Modal -->
<div class="modal fade" id="closeSessionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Close POS Session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="closeSessionForm" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="sessionIdInput" name="session_id" value="">
                    <div class="mb-3">
                        <label for="closingAmount" class="form-label">Closing Amount (KSH)</label>
                        <input type="number" class="form-control" id="closingAmount" name="closing_amount" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="closeNotes" class="form-label">Notes (Optional)</label>
                        <textarea class="form-control" id="closeNotes" name="notes" rows="3"></textarea>
                    </div>
                    <div class="alert alert-info">
                        <i data-feather="info" class="feather-16 me-2"></i>
                        <strong>Note:</strong> The closing amount is pre-calculated as Opening Amount + Current Sales. You can adjust it if needed.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Close Session</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Global variable to store current session ID
var currentSessionId = '<?php echo $active_session['session_id'] ?? ''; ?>';

$(document).ready(function() {
    // Auto-refresh session data every 30 seconds
    setInterval(function() {
        location.reload();
    }, 30000);
    
    // Disable "Open Session" button if there's already an active session
    if (currentSessionId) {
        $('.btn[data-bs-target="#openSessionModal"]').addClass('disabled').prop('disabled', true);
    }
    
    // Open Session Form
    $('#openSessionForm').on('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        var submitBtn = $(this).find('button[type="submit"]');
        var originalText = submitBtn.text();
        submitBtn.text('Opening...').prop('disabled', true);
        
        $.ajax({
            url: 'open_pos_session.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response);
                if (response.success) {
                    // Show success notification
                    showNotification('Session opened successfully!', 'success');
                    // Close the modal
                    $('#openSessionModal').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    showNotification('Error: ' + response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', xhr.responseText);
                console.log('Status:', status);
                console.log('Error:', error);
                
                // Try to parse error response
                try {
                    var errorResponse = JSON.parse(xhr.responseText);
                    showNotification('Error: ' + (errorResponse.message || 'Unknown error occurred'), 'error');
                } catch (e) {
                    showNotification('Error: Network error occurred while opening session', 'error');
                }
            },
            complete: function() {
                submitBtn.text(originalText).prop('disabled', false);
            }
        });
    });

    // Close Session Button Click Handler
    $(document).on('click', '.close-session-btn', function(e) {
        var sessionId = $(this).data('session-id');
        console.log('Close session button clicked - Session ID:', sessionId);
        
        if (sessionId) {
            $('#sessionIdInput').val(sessionId);
            console.log('Session ID set in hidden input via click handler:', $('#sessionIdInput').val());
            
            // Calculate and populate closing amount
            calculateClosingAmount(sessionId);
        } else {
            console.error('No session ID found in close session button!');
        }
    });

    // Close Session Form - Modal Event (fallback)
    $('#closeSessionModal').on('show.bs.modal', function(e) {
        var sessionId = $(e.relatedTarget).data('session-id');
        console.log('Modal opened - Session ID from button:', sessionId);
        
        if (sessionId) {
            $('#sessionIdInput').val(sessionId);
            console.log('Session ID set in hidden input via modal event:', $('#sessionIdInput').val());
            
            // Calculate and populate closing amount
            calculateClosingAmount(sessionId);
        } else {
            console.error('No session ID found in button data!');
        }
    });

    $('#closeSessionForm').on('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        var submitBtn = $(this).find('button[type="submit"]');
        var originalText = submitBtn.text();
        submitBtn.text('Closing...').prop('disabled', true);
        
        var sessionId = $('#sessionIdInput').val();
        console.log('Form submitted - Session ID from hidden input:', sessionId);
        console.log('Global session ID:', currentSessionId);
        console.log('All form data:', $(this).serialize());
        
        // Fallback to global session ID if hidden input is empty
        if (!sessionId && currentSessionId) {
            sessionId = currentSessionId;
            $('#sessionIdInput').val(sessionId);
            console.log('Using fallback session ID:', sessionId);
        }
        
        if (!sessionId) {
            showNotification('Error: Session ID not found. Please try again.', 'error');
            submitBtn.text(originalText).prop('disabled', false);
            return;
        }
        
        // Ensure session ID is included in the form data
        var formData = $(this).serialize();
        if (!formData.includes('session_id=' + sessionId)) {
            formData += '&session_id=' + encodeURIComponent(sessionId);
        }
        
        $.ajax({
            url: 'close_pos_session.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response);
                if (response.success) {
                    showNotification('Session closed successfully!', 'success');
                    // Close the modal
                    $('#closeSessionModal').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    showNotification('Error: ' + response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', xhr.responseText);
                console.log('Status:', status);
                console.log('Error:', error);
                
                // Try to parse error response
                try {
                    var errorResponse = JSON.parse(xhr.responseText);
                    showNotification('Error: ' + (errorResponse.message || 'Unknown error occurred'), 'error');
                } catch (e) {
                    showNotification('Error: Network error occurred while closing session', 'error');
                }
            },
            complete: function() {
                submitBtn.text(originalText).prop('disabled', false);
            }
        });
    });
    
    // Calculate and populate closing amount
    function calculateClosingAmount(sessionId) {
        console.log('Calculating closing amount for session:', sessionId);
        
        // Ensure session ID is set in hidden input
        $('#sessionIdInput').val(sessionId);
        console.log('Session ID set in hidden input:', $('#sessionIdInput').val());
        
        // Get the close session button that was clicked
        var closeBtn = $('.close-session-btn[data-session-id="' + sessionId + '"]');
        var openingAmount = parseFloat(closeBtn.data('opening-amount') || 0);
        var currentSales = parseFloat(closeBtn.data('current-sales') || 0);
        
        console.log('Opening amount:', openingAmount, 'Current sales:', currentSales);
        
        // Calculate expected closing amount (opening + sales)
        var expectedClosingAmount = openingAmount + currentSales;
        
        // Populate the closing amount input
        $('#closingAmount').val(expectedClosingAmount.toFixed(2));
        
        // Add a helpful note
        var noteText = 'Expected closing amount: KSH ' + expectedClosingAmount.toFixed(2) + 
                      ' (Opening: KSH ' + openingAmount.toFixed(2) + ' + Sales: KSH ' + currentSales.toFixed(2) + ')';
        $('#closeNotes').val(noteText);
        
        console.log('Closing amount calculated:', expectedClosingAmount);
        console.log('Form data after calculation:', $('#closeSessionForm').serialize());
    }
    
    // Enhanced notification function
    function showNotification(message, type) {
        var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        var icon = type === 'success' ? 'check-circle' : 'alert-triangle';
        
        // Remove any existing notifications first
        $('.alert').remove();
        
        var notification = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                <i data-feather="${icon}" class="feather-16 me-2"></i>
                <strong>${type === 'success' ? 'Success!' : 'Error!'}</strong> ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        // Insert at the top of the page
        $('body').append(notification);
        
        // Reinitialize feather icons
        feather.replace();
        
        // Auto-dismiss after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut(function() {
                $(this).remove();
            });
        }, 5000);
    }
});
</script>

<?php include_once "./includes/footer.php"; ?> 