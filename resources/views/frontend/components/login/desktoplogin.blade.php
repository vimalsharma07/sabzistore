<!-- OTP Modal -->
<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="otpModalLabel">OTP Verification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="mobileInputSection">
                    <h5>India's last minute app</h5>
                    <p>Log in or Sign up</p>
                    <div class="mb-3 input-group">
                        <span class="input-group-text">+91</span>
                        <input type="text" class="form-control" id="mobileNumber" placeholder="9999999999"
                            aria-label="Mobile Number">
                    </div>
                    <button class="btn btn-success btn-lg rounded-pill w-100" id="sendOtpButton">Send OTP</button>
                    <p class="mt-3 terms">
                        By continuing, you agree to our
                        <a href="#">Terms of service</a>
                        &amp;
                        <a href="#">Privacy policy</a>
                    </p>
                    <p>
                        <a href="{{ url('/login') }}"> Login with Password</a>
                    </p>
                </div>

                <div id="otpInputSection" style="display: none;">
                    <p>We have sent a verification code to</p>
                    <h5 id="displayedMobileNumber">+91-9999999999</h5>

                     
                    <div class="gap-2 mb-3 d-flex">
                        <div><input class="px-0 py-3 text-center shadow-none form-control otp-input" type="text" maxlength="1" inputmode="numeric"></div>
                        <div><input class="px-0 py-3 text-center shadow-none otp-input form-control" type="text" maxlength="1" inputmode="numeric"></div>
                        <div><input class="px-0 py-3 text-center shadow-none otp-input form-control" type="text" maxlength="1" inputmode="numeric"></div>
                        <div><input class="px-0 py-3 text-center shadow-none otp-input form-control" type="text" maxlength="1" inputmode="numeric"></div>
                    </div>

                    <p class="resend-code" id="resendCode">Resend Code (in <span id="timer">90</span> secs)</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let timer = 90;
        let otpTimer;

        // Function to start countdown timer
        function startTimer() {
            otpTimer = setInterval(function() {
                $('#timer').text(timer);
                if (timer <= 0) {
                    clearInterval(otpTimer);
                    $('#resendCode').text('Resend Code');
                    $('#resendCode').off('click').on('click', resendOtp);
                }
                timer--;
            }, 1000);
        }

        // Send OTP
        $('#sendOtpButton').click(function() {
            const mobileNumber = $('#mobileNumber').val();
            if (mobileNumber && mobileNumber.length === 10) {
                // Send OTP to the backend
                $.post('/send-otp', {
                    mobile_number: mobileNumber
                }, function(response) {
                    if (response.message === 'OTP sent successfully.') {
                        alert(response.otp);
                        $('#mobileInputSection').hide();
                        $('#otpInputSection').show();
                        $('#displayedMobileNumber').text('+91-' + mobileNumber);
                        startTimer();
                    } else {
                        alert(response.message);
                    }
                });
            } else {
                alert('Please enter a valid 10-digit mobile number.');
            }
        });

        // Handle OTP input
        $('.otp-input').on('input', function() {
            const inputs = $('.otp-input');
            let otp = '';
            inputs.each(function() {
                otp += $(this).val();
            });

            // Move focus to the next input field when the current one is filled
            const currentInput = $(this);
            if (currentInput.val().length === 1) {
                currentInput.next('.otp-input').focus();
            }

            if (otp.length === 4) {
                validateOtp(otp);
            }
        });

        // Validate OTP
        function validateOtp(otp) {
            const mobileNumber = $('#mobileNumber').val();

            $.ajax({
                url: '/validate-otp',
                type: 'POST',
                data: {
                    mobile_number: mobileNumber,
                    otp: otp
                },
                success: function(response) {
                    if (response.message === 'OTP validated successfully.') {
                        location.reload();
                        $('#otpModal').modal('hide');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Check for 500 server error and handle
                    console.log(xhr.responseText);
                    if (xhr.status === 500) {
                        alert('Internal Server Error. Please try again later.');
                    } else {
                        // Log the error message and response for debugging
                        console.error('Error Status: ' + status);
                        console.error('Error Message: ' + error);
                        console.error('Response Text: ' + xhr.responseText);
                        alert('An error occurred. Please try again.');
                    }
                }
            });
        }


        // Resend OTP (after countdown expires)
        function resendOtp() {
            const mobileNumber = $('#mobileNumber').val();
            $.post('/send-otp', {
                mobile_number: mobileNumber
            }, function(response) {
                if (response.message === 'OTP sent successfully.') {
                    $('#resendCode').text('Resend Code (in 90 secs)');
                    timer = 90;
                    startTimer();
                } else {
                    alert(response.message);
                }
            });
        }
    });
</script>
