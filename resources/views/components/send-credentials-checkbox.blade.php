{{-- resources/views/components/send-credentials-checkbox.blade.php --}}

<div class="form-group">
    <div class="checkbox-group">
        <label class="custom-checkbox">
            <input type="checkbox" 
                   id="sendCredentials" 
                   name="sendCredentials" 
                   value="1"
                   {{ old('sendCredentials', true) ? 'checked' : '' }}>
            <span class="checkmark"></span>
        </label>
        <label for="sendCredentials" class="form-label">
            📧 Send Login Credentials
        </label>
        <div class="help-text">
            <span class="icon">ℹ️</span>
            Send login credentials to the {{ $userType === 'student' ? 'student\'s' : 'teacher\'s' }} email address
            @if($userType === 'student')
                <br><small>Parent will also be notified if parent email is provided</small>
            @endif
        </div>
    </div>
</div>

<style>
.checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 20px;
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    margin: 15px 0;
    transition: all 0.3s ease;
}

.checkbox-group:hover {
    background: #e9ecef;
    border-color: #dee2e6;
}

.custom-checkbox {
    position: relative;
    display: flex;
    align-items: center;
    padding-left: 35px;
    margin-bottom: 0;
    cursor: pointer;
    font-size: 16px;
    user-select: none;
}

.custom-checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    height: 20px;
    width: 20px;
    background-color: #fff;
    border: 2px solid #ddd;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.custom-checkbox:hover input ~ .checkmark {
    background-color: #f0f8ff;
    border-color: #007bff;
}

.custom-checkbox input:checked ~ .checkmark {
    background-color: #007bff;
    border-color: #007bff;
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
    left: 6px;
    top: 2px;
    width: 6px;
    height: 12px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.custom-checkbox input:checked ~ .checkmark:after {
    display: block;
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.help-text {
    color: #6c757d;
    font-size: 14px;
    line-height: 1.4;
    display: flex;
    align-items: flex-start;
    gap: 6px;
    margin-top: 5px;
}

.help-text .icon {
    font-size: 16px;
    flex-shrink: 0;
    margin-top: 1px;
}

.help-text small {
    color: #6c757d;
    font-style: italic;
    margin-top: 3px;
}

@keyframes checkmark {
    0% { transform: rotate(45deg) scale(0); }
    50% { transform: rotate(45deg) scale(1.1); }
    100% { transform: rotate(45deg) scale(1); }
}

.custom-checkbox input:checked ~ .checkmark:after {
    animation: checkmark 0.3s ease-in-out;
}

@media (max-width: 768px) {
    .checkbox-group { padding: 15px; }
    .custom-checkbox { font-size: 14px; padding-left: 30px; }
    .checkmark { height: 18px; width: 18px; }
    .checkmark:after { left: 5px; top: 1px; width: 5px; height: 10px; }
}
</style>