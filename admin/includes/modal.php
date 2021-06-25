
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contact-modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <div class="d-flex">
          <h5 class="modal-title" id="contactModalLabel">Let's Talk!</h5>
          <lottie-player class="walkie-talkie ms-2" src="https://assets7.lottiefiles.com/packages/lf20_Y0ssVY.json"  background="transparent"  speed="1"  style="width: 30px; height: 30px;"  loop  autoplay></lottie-player>
        </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="post">
        <div class="form-floating mb-3">
              <input type="text" name="name" class="form-control" placeholder="Name">
              <label for="floatingInput">Name</label>
        </div>
        <div class="form-floating mb-3">
              <input type="email" name="email" class="form-control" placeholder="Email">
              <label for="floatingInput">Email</label>
        </div>
        <div class="mb-3">
                <label for="floatingPassword">Message</label>
                <textarea class="form-control" name="desc" rows="5" placeholder="Type your message here..."></textarea>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="submit" class="btn btn-sm">Send</button>
        </div>
        </form>
      </div>
    </div>
  </div>