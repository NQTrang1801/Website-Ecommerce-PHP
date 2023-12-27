@extends('layouts.app-home')

@section('styles')
 <base href="/public">
  <link rel="stylesheet" href="home/styles/pages/service.css">
@endsection

@section('content')
  <main>
    <p class="label">Customer Service</p>
    <div class="wrapper">
      <div class="wrapper-left">
        <div>
          CUSTOMER SERVICE / CONTACT US
        </div>
        <div></div>
        <div>
          <p>NEED HELP?</p>
          <p>If you have questions or need assistance, please contact us:</p>
        </div>
        <div>
            <i class="ri-phone-line"></i>
          <div>
            <p>111-222-333</p>
            <br>
            <p>We're Available:</p>
            <p>Mon - Sun: 8:00am - 10:00pm</p>
          </div>
        </div>
        <div>
          <i class="ri-smartphone-line"></i>
        <div>
          <p>Text Us</p>
          <br>
          <p>1-333-444-5556</p>
        </div>
      </div>
      </div>
      <div class="wrapper-right">
        <div>
          <div class="right-intro">
            <p>CONTACT US</p>
            <p>*Required</p>
          </div>
          <p class="text-intro">WE WANT TO HEAR FROM YOU...</p>
          <p class="text">It is our priority to provide you with the exceptional service you have come to expect from Private. Your feedback is important to us.</p>
          <p class="text">Please note that Private does not use your email for promotional purposes or disclose it to a third party.</p>
          <p class="text">Please be sure to include in any email or postal mail request your full name, email address, postal address, and any message.</p>
        </div>
        <div>
          <p class="text-contact">Contact Us</p>
          <form action="">
            <div class="input-box">
              <input type="text" required>
              <span>*FIRST NAME</span>
              <div class="require-message">This field is required.</div>
            </div>
            <div class="input-box">
              <input type="text" required>
              <span>*LAST NAME</span>
              <div class="require-message">This field is required.</div>
            </div>
            <div class="input-box">
              <input type="email" class="has-email" required>
              <span class="has-email-span">*EMAIL</span>
              <div class="require-message">This field is required.</div>
              <div class="valid-email">Please enter a valid email address (eg. private@gmail.com).</div>
            </div>
            <div class="input-box">
              <textarea class="has-textarea" name="" id="" cols="30" rows="10" required></textarea>
              <span class="has-textarea-span textarea-span">*YOUR MESSAGE</span>
              <div class="require-message">This field is required.</div>
            </div>
            <input type="submit" value="SEND">
          </form>
        </div>
      </div>
    </div>
  </main>
  @endsection
  
@section('scripts')
  <script type="module" src="home/scripts/service.js"></script>
@endsection