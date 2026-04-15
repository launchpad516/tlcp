<?php
/**
 * Template Name: Contact
 *
 * @package LegalClarity
 */

get_header();

$tlcp_success = isset( $_GET['tlcp_success'] ) && '1' === $_GET['tlcp_success'];
$tlcp_error   = isset( $_GET['tlcp_error'] ) && '1' === $_GET['tlcp_error'];
?>

<section class="page-hero">
    <div class="container">
        <div class="eyebrow">Contact</div>
        <h1>Get in touch</h1>
        <p class="lead">If you have questions, suggestions, or ideas, you are welcome to reach out.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid grid-2">
            <div>
                <h2>Send a message</h2>

                <?php if ( $tlcp_success ) : ?>
                    <div class="callout" role="status">
                        <p>Thank you! Your message has been sent.</p>
                    </div>
                <?php endif; ?>

                <?php if ( $tlcp_error ) : ?>
                    <div class="callout" role="alert" style="border-color:#c53030;background:#fef2f2;">
                        <p>Please fill in all required fields and try again.</p>
                    </div>
                <?php endif; ?>

                <form class="tlcp-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                    <input type="hidden" name="action" value="tlcp_submit">
                    <input type="hidden" name="tlcp_form_action" value="contact">
                    <?php wp_nonce_field( 'tlcp_form', 'tlcp_nonce' ); ?>

                    <div aria-hidden="true" style="display:none;">
                        <label for="tlcp-contact-website">Website</label>
                        <input type="text" id="tlcp-contact-website" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="tlcp-contact-name">Name <span aria-hidden="true">*</span></label>
                        <input type="text" id="tlcp-contact-name" name="name" required aria-required="true">
                    </div>

                    <div class="form-group">
                        <label for="tlcp-contact-email">Email <span aria-hidden="true">*</span></label>
                        <input type="email" id="tlcp-contact-email" name="email" required aria-required="true">
                    </div>

                    <div class="form-group">
                        <label for="tlcp-contact-subject">Subject</label>
                        <input type="text" id="tlcp-contact-subject" name="subject">
                    </div>

                    <div class="form-group">
                        <label for="tlcp-contact-message">Message <span aria-hidden="true">*</span></label>
                        <textarea id="tlcp-contact-message" name="message" rows="6" required aria-required="true"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>

            <div>
                <div class="contribute-card">
                    <h2>Reach Lily directly</h2>
                    <p>
                        <a href="mailto:lily.defendini@gmail.com"><?php echo esc_html( 'lily.defendini@gmail.com' ); ?></a>
                    </p>
                    <p>This project is built to make legal information more accessible, and your feedback helps improve it.</p>
                    <p><em>For legal advice, please consult a qualified attorney &mdash; we are not able to provide specific legal guidance.</em></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
