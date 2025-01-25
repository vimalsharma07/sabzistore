
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
                        <input type="text" class="form-control" id="mobileNumber" placeholder="9999999999" aria-label="Mobile Number">
                    </div>
                    <button class="btn btn-success btn-lg rounded-pill w-100" id="sendOtpButton">Send OTP</button>
                    <p class="mt-3 terms">
                        By continuing, you agree to our
                        <a href="#">Terms of service</a>
                        &amp;
                        <a href="#">Privacy policy</a>
                    </p>
                    <p>
                        <a href="{{url('/login')}}"> Login with Password</a>
                    </p>
                </div>

                <div id="otpInputSection" style="display: none;">
                    <p>We have sent a verification code to</p>
                    <h5 id="displayedMobileNumber">+91-9999999999</h5>
  
                    <div class="d-flex justify-content-center my-4">
 
                        <input type="text" class="otp-input" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-input" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-input" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-input" maxlength="1" inputmode="numeric">
                    </div>
                    <p class="resend-code" id="resendCode">Resend Code (in <span id="timer">90</span> secs)</p>
                </div>
            </div>
        </div>
    </div>
</div> 

