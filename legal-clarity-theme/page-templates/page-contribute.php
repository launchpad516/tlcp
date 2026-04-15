<?php
/**
 * Template Name: Contribute
 *
 * @package LegalClarity
 */

get_header();

$tlcp_success = isset( $_GET['tlcp_success'] ) && '1' === $_GET['tlcp_success'];
$tlcp_error   = isset( $_GET['tlcp_error'] ) && '1' === $_GET['tlcp_error'];
?>

<section class="page-hero">
    <div class="container">
        <div class="eyebrow">Contribute</div>
        <h1>Help shape The Legal Clarity Project</h1>
        <p class="lead">Your feedback, suggestions, and contributions help make legal information more accessible to everyone.</p>
    </div>
</section>

<section class="section">
    <div class="container container-narrow">
        <div class="prose">
            <h2>Ways to get involved</h2>
            <p><strong>Suggest a Term</strong> &mdash; If there is a legal word or phrase you do not understand, you can suggest it to be added to the dictionary. Please include the term or phrase and where you encountered it, if possible.</p>
            <p><strong>Share a Question</strong> &mdash; If you are unsure about your rights in a specific situation, you can submit a general question. While this site does not provide legal advice, questions can help guide future content and explanations.</p>
            <p><strong>Contribute</strong> &mdash; If you are interested in contributing to this project, you can suggest edits or clearer definitions, recommend topics, or share ideas for making legal language more understandable.</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container container-narrow">
        <h2>Suggest a Term</h2>

        <?php if ( $tlcp_success ) : ?>
            <div class="callout" role="status">
                <p>Thank you! Your suggestion has been sent.</p>
            </div>
        <?php endif; ?>

        <?php if ( $tlcp_error ) : ?>
            <div class="callout" role="alert" style="border-color:#c53030;background:#fef2f2;">
                <p>Please fill in all required fields and try again.</p>
            </div>
        <?php endif; ?>

        <form class="tlcp-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
            <input type="hidden" name="action" value="tlcp_submit">
            <input type="hidden" name="tlcp_form_action" value="suggest_term">
            <?php wp_nonce_field( 'tlcp_form', 'tlcp_nonce' ); ?>

            <div aria-hidden="true" style="display:none;">
                <label for="tlcp-website">Website</label>
                <input type="text" id="tlcp-website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="form-group">
                <label for="tlcp-name">Name <span aria-hidden="true">*</span></label>
                <input type="text" id="tlcp-name" name="name" required aria-required="true">
            </div>

            <div class="form-group">
                <label for="tlcp-email">Email <span aria-hidden="true">*</span></label>
                <input type="email" id="tlcp-email" name="email" required aria-required="true">
            </div>

            <div class="form-group">
                <label for="tlcp-term">Term <span aria-hidden="true">*</span></label>
                <input type="text" id="tlcp-term" name="term" required aria-required="true">
            </div>

            <div class="form-group">
                <label for="tlcp-source">Where you encountered it</label>
                <input type="text" id="tlcp-source" name="source">
            </div>

            <div class="form-group">
                <label for="tlcp-message">Message <span aria-hidden="true">*</span></label>
                <textarea id="tlcp-message" name="message" rows="5" required aria-required="true"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send Suggestion</button>
        </form>
    </div>
</section>

<section class="section">
    <div class="container container-narrow">
        <div class="callout">
            <p>This website is for informational purposes only and does not provide legal advice. For legal help, you should contact a qualified attorney.</p>
        </div>
    </div>
</section>

<?php get_footer();
