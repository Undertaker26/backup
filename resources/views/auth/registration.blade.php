<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="logo2.png" type="image/x-icon">
  <link rel="stylesheet" href="register.css">
  <script src="register.js" defer></script>
  <title>University Scribe Registration</title>


</head>
<body>

<section>
  <div class="container">
    <img src="logo.png" alt="University Scribe Logo">
    <form method="POST" action="{{ route('register.post') }}" onsubmit="validateForm(event)">
      @csrf

      @session('error')
          <div class="alert alert-danger" role="alert"> 
              {{ $value }}
          </div>
      @endsession

      <input type="text" class="form-control @error('student_id') is-invalid @enderror" name="student_id" id="student_id" placeholder="Student ID Number" required>
      <div class="error-message" id="student_id_error"></div>
      @error('student_id')
            <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" required>
      <div class="error-message" id="username_error"></div>
      @error('username')
            <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <div class="row">
      <select class="form-control @error('course') is-invalid @enderror" name="course" id="course" required>
        <option value="" selected disabled>Select Course</option>
        <option value="BSIT">Bachelor of Science in Information Technology</option>
        <option value="BSCRIM">Bachelor of Science in Criminology</option>
        <option value="BSPHAR">Bachelor of Science in Pharmacy</option>
        <option value="BAComm">Bachelor of Arts in Communication</option>
        <option value="BSMid">Bachelor of Science in Midwifery</option>
        <option value="BLIS">Bachelor of Library & Information Science</option>
        <option value="BSHM">Bachelor of Science in Hospitality Management</option>
        <option value="BSTM">Bachelor of Science in Tourism Management</option>
        <option value="BSArch">Bachelor of Science in Architecture</option>
        <option value="BSCE">Bachelor of Science in Civil Engineering</option>
        <option value="BSCpE">Bachelor of Science in Computer Engineering</option>
        <option value="BSEE">Bachelor of Science in Electrical Engineering</option>
        <option value="BSECE">Bachelor of Science in Electronics Engineering</option>
        <option value="BSPsy">Bachelor of Science in Psychology</option>
        <option value="BSSW">Bachelor of Science in Social Work</option>
        <option value="BCAEd">Bachelor of Culture and Arts Education</option>
        <option value="BECEd">Bachelor of Early Childhood Education</option>
        <option value="BEEd">Bachelor of Elementary Education</option>
        <option value="BPEd">Bachelor of Physical Education</option>
        <option value="BSEd">Bachelor of Secondary Education</option>
        <option value="BSNEd">Bachelor of Special Needs Education</option>
        <option value="BSA">Bachelor of Science in Accountancy</option>
        <option value="BSBA">Bachelor of Science in Business Administration</option>
        <option value="BSMA">Bachelor of Science in Management Accounting</option>
        <option value="BSOA">Bachelor of Science in Office Administration</option>
      </select>
      @error('course')
              <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror


<select class="form-control @error('status') is-invalid @enderror" name="status" id="status" required>
    <option value="" selected disabled>Select Status</option>
    <option value="current_student" {{ old('status') == 'current_student' ? 'selected' : '' }}>Current Student</option>
    <option value="alumni" {{ old('status') == 'alumni' ? 'selected' : '' }}>Alumni</option>
</select>
@error('status')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

      </div>
      <input type="date" class="form-control @error('bday') is-invalid @enderror" name="bday" id="bday" placeholder="Date of Birth" required>
<div class="error-message" id="bday_error"></div>
@error('bday')
    <span class="text-danger" role="alert">
      <strong>{{ $message }}</strong>
    </span>
@enderror
      <div class="rows">
        <select class="form-control @error('province') is-invalid @enderror" name="province" id="province" onchange="populateCities()" required>
          <option value="" selected disabled>Select Province</option>
          <!-- Options will be populated dynamically -->
        </select>
        <div class="error-message" id="province_error"></div>
        @error('province')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror

        <select class="form-control @error('city') is-invalid @enderror" name="city" id="city" onchange="populateBarangays()" required>
          <option value="" selected disabled>Select City</option>
          <!-- Options will be populated dynamically -->
        </select>
        <div class="error-message" id="city_error"></div>
        @error('city')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror

        <select class="form-control @error('barangay') is-invalid @enderror" name="barangay" id="barangay" required>
          <option value="" selected disabled>Select Barangay</option>
          <!-- Options will be populated dynamically -->
        </select>
        <div class="error-message" id="barangay_error"></div>
        @error('barangay')
          <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email Address" required>
      <div class="error-message" id="email_error"></div>
      @error('email')
            <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required>
      @error('password')
          <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

      <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
      <div class="error-message" id="password_error"></div>
      @error('password_confirmation')
          <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
<br>
      <button type="submit">{{ __('Register') }}</button>

    </form>

    <div class="spacer"></div>

    <p>Already have an account? <a class="register-link" href="{{ route('login') }}">{{ __('Login') }}</a></p>
  </div>
</section>
</body>
</html>
