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
                            echo "<div class='alert alert-success'>
                                    <h5><i data-feather='check-circle' class='feather-16 me-2'></i>Active Session</h5>
                                    <p><strong>Session ID:</strong> {$active_session['session_id']}</p>
                                    <p><strong>Opening Amount:</strong> KSH " . number_format($active_session['opening_amount'], 2) . "</p>
                                    <p><strong>Opening Time:</strong> " . date('M d, Y H:i', strtotime($active_session['opening_time'])) . "</p>
                                    <p><strong>Total Sales:</strong> KSH " . number_format($active_session['total_sales'], 2) . "</p>
                                    <p><strong>Total Transactions:</strong> {$active_session['total_transactions']}</p>
                                    <a href='#' class='btn btn-warning close-session-btn' data-bs-toggle='modal' data-bs-target='#closeSessionModal' data-session-id='{$active_session['session_id']}'>
                                        <i data-feather='lock' class='me-2'></i>Close Session
                                    </a>
                                  </div>";
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
                                        <th>Status</th>
                                        <th>Date</th>
                                        <!-- <th>Actions</th> -->
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
                                        echo "<tr>
                                                <td>{$session['session_id']}</td>
                                                <td>KSH " . number_format($session['opening_amount'], 2) . "</td>
                                                <td>KSH " . number_format($session['closing_amount'], 2) . "</td>
                                                <td>KSH " . number_format($session['total_sales'], 2) . "</td>
                                                <td>{$session['total_transactions']}</td>
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
            <form id="openSessionForm" action="open_pos_session.php" method="POST">
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
            <form id="closeSessionForm" action="close_pos_session.php" method="POST">
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
$(document).ready(function() {
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
                    alert('Session opened successfully!');
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', xhr.responseText);
                alert('Error opening session: ' + error);
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
        } else {
            console.error('No session ID found in close session button!');
        }
    });

    // Close Session Form - Modal Event (fallback)
    $('#closeSessionModal').on('show.bs.modal', function(e) {
        var sessionId = $(e.relatedTarget).data('session-id');
        console.log('Modal opened - Session ID from button:', sessionId);
        console.log('Button element:', e.relatedTarget);
        console.log('Button data attributes:', $(e.relatedTarget).data());
        
        if (sessionId) {
            $('#sessionIdInput').val(sessionId);
            console.log('Session ID set in hidden input via modal event:', $('#sessionIdInput').val());
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
        console.log('All form data:', $(this).serialize());
        
        if (!sessionId) {
            alert('Error: Session ID not found. Please try again.');
            submitBtn.text(originalText).prop('disabled', false);
            return;
        }
        
        $.ajax({
            url: 'close_pos_session.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response);
                if (response.success) {
                    alert('Session closed successfully!');
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', xhr.responseText);
                alert('Error closing session: ' + error);
            },
            complete: function() {
                submitBtn.text(originalText).prop('disabled', false);
            }
        });
    });
});
</script>

<?php include_once "./includes/footer.php"; ?> 