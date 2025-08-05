<?php
session_start();
include './config/config.php';

// Get the current active session for testing
$employee_id = $_SESSION['employee_id'] ?? 0;
$active_session_query = "SELECT * FROM pos_sessions WHERE employee_id = ? AND status = 'open' ORDER BY opening_time DESC LIMIT 1";
$stmt = $conn->prepare($active_session_query);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$active_session = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Session Debug</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Session Debug Test</h2>
        
        <?php if ($active_session): ?>
            <div class="alert alert-info">
                <h4>Active Session Found:</h4>
                <p><strong>Session ID:</strong> <?php echo $active_session['session_id']; ?></p>
                <p><strong>Opening Amount:</strong> KSH <?php echo number_format($active_session['opening_amount'], 2); ?></p>
            </div>
            
            <button class="btn btn-warning close-session-btn" data-bs-toggle="modal" data-bs-target="#closeSessionModal" data-session-id="<?php echo $active_session['session_id']; ?>">
                Test Close Session
            </button>
        <?php else: ?>
            <div class="alert alert-warning">No active session found.</div>
        <?php endif; ?>
        
        <div class="mt-3">
            <h4>Debug Info:</h4>
            <div id="debug-info"></div>
        </div>
    </div>

    <!-- Close Session Modal -->
    <div class="modal fade" id="closeSessionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Close Session Test</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="closeSessionForm">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Close Session Button Click Handler
            $(document).on('click', '.close-session-btn', function(e) {
                var sessionId = $(this).data('session-id');
                console.log('Close session button clicked - Session ID:', sessionId);
                $('#debug-info').append('<p>Button clicked - Session ID: ' + sessionId + '</p>');
                
                if (sessionId) {
                    $('#sessionIdInput').val(sessionId);
                    console.log('Session ID set in hidden input via click handler:', $('#sessionIdInput').val());
                    $('#debug-info').append('<p>Session ID set in hidden input: ' + $('#sessionIdInput').val() + '</p>');
                } else {
                    console.error('No session ID found in close session button!');
                    $('#debug-info').append('<p style="color: red;">ERROR: No session ID found!</p>');
                }
            });

            // Modal Event
            $('#closeSessionModal').on('show.bs.modal', function(e) {
                var sessionId = $(e.relatedTarget).data('session-id');
                console.log('Modal opened - Session ID from button:', sessionId);
                $('#debug-info').append('<p>Modal opened - Session ID: ' + sessionId + '</p>');
                
                if (sessionId) {
                    $('#sessionIdInput').val(sessionId);
                    console.log('Session ID set in hidden input via modal event:', $('#sessionIdInput').val());
                    $('#debug-info').append('<p>Session ID set via modal event: ' + $('#sessionIdInput').val() + '</p>');
                } else {
                    console.error('No session ID found in button data!');
                    $('#debug-info').append('<p style="color: red;">ERROR: No session ID in modal event!</p>');
                }
            });

            // Form Submit
            $('#closeSessionForm').on('submit', function(e) {
                e.preventDefault();
                
                var sessionId = $('#sessionIdInput').val();
                var formData = $(this).serialize();
                
                console.log('Form submitted - Session ID:', sessionId);
                console.log('Form data:', formData);
                
                $('#debug-info').append('<p>Form submitted - Session ID: ' + sessionId + '</p>');
                $('#debug-info').append('<p>Form data: ' + formData + '</p>');
                
                if (!sessionId) {
                    alert('Error: Session ID not found!');
                    $('#debug-info').append('<p style="color: red;">ERROR: Session ID missing in form!</p>');
                    return;
                }
                
                // Test AJAX call
                $.ajax({
                    url: 'close_pos_session.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        console.log('Response:', response);
                        $('#debug-info').append('<p style="color: green;">Success: ' + JSON.stringify(response) + '</p>');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', xhr.responseText);
                        $('#debug-info').append('<p style="color: red;">Error: ' + xhr.responseText + '</p>');
                    }
                });
            });
        });
    </script>
</body>
</html> 