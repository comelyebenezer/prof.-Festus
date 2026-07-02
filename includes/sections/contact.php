<section class="contact section-padding" id="contact">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Contact</span>
            <h2 class="section-title">Get In Touch</h2>
            <p class="section-subtitle">
                Have a question, collaboration idea, or want to connect? Reach out and let's
                start a conversation about how we can work together.
            </p>
        </div>

        <div class="contact-grid">
            <div class="contact-info reveal-left">
                <h3>Let's Connect</h3>
                <p>
                    Whether you're interested in collaboration, speaking engagements, real estate
                    partnerships, or simply want to share your thoughts, I look forward to hearing
                    from you.
                </p>

                <div class="contact-details">
                    <div class="contact-detail">
                        <div class="detail-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h5>Email</h5>
                            <span>drfestusasikhia@gmail.com</span>
                        </div>
                    </div>
                    <div class="contact-detail">
                        <div class="detail-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <h5>Phone</h5>
                            <span>08091769651</span>
                        </div>
                    </div>
                    <div class="contact-detail">
                        <div class="detail-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h5>Location</h5>
                            <span>Nigeria</span>
                        </div>
                    </div>
                    <div class="contact-detail">
                        <div class="detail-icon"><i class="fas fa-clock"></i></div>
                        <div>
                            <h5>Availability</h5>
                            <span>Open for collaborations and engagements</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reveal-right">
                <form class="contact-form" id="contactForm" method="POST" action="contact_process.php">
                    <div id="formMessage" class="form-message"></div>

                    <div class="form-group">
                        <label for="name">Your Name *</label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Your Email *</label>
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="Enter your email address" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone"
                               placeholder="Enter your phone number">
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <input type="text" class="form-control" id="subject" name="subject"
                               placeholder="What is this regarding?" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Your Message *</label>
                        <textarea class="form-control" id="message" name="message"
                                  placeholder="Write your message here..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                        <i class="fas fa-paper-plane"></i>
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
