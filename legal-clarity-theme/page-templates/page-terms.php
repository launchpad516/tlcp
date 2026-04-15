<?php
/**
 * Template Name: Terms and Conditions
 *
 * @package LegalClarity
 */
get_header(); ?>

<section class="page-hero">
	<div class="container-narrow">
		<p class="eyebrow"><?php echo esc_html__( 'Legal', 'legal-clarity' ); ?></p>
		<h1><?php echo esc_html__( 'Terms and Conditions', 'legal-clarity' ); ?></h1>
		<p class="lead"><?php echo esc_html__( 'By accessing or using this site, you agree to these Terms and Conditions. Please read them carefully.', 'legal-clarity' ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container-narrow prose">
		<p><strong><?php echo esc_html__( 'Effective Date:', 'legal-clarity' ); ?></strong> <?php echo esc_html__( 'January 1, 2026', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '1. Purpose of This Website', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'This website is designed to provide plain-language explanations of legal terms and concepts to improve public understanding of the law. The content is for educational and informational purposes only. This is based on the Merriam-Webster legal dictionary.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '2. No Legal Advice', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'The information provided on this website does not constitute legal advice and should not be relied upon as such. You should not act or refrain from acting based on any content on this site without seeking professional legal counsel from a qualified attorney.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '3. No Attorney-Client Relationship', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'Use of this website, including contacting the creator, does not create an attorney-client relationship.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '4. Accuracy of Information and No Guaranteed Outcome', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'While efforts are made to ensure the accuracy and clarity of the information, the law is constantly evolving. We do not guarantee that all content is complete, accurate, or up to date. The information on this website is for educational purposes only. Use of this website, its definitions, or its resources does not guarantee any specific legal result, success in a legal proceeding, or the protection of your rights in a court of law.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '5. Intellectual Property', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'All content on this website, including text, design, and structure, is the property of the site creator unless otherwise stated. You may not reproduce, distribute, or modify any content without permission.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '6. User Contributions', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'If you submit suggestions, feedback, or content (such as through a contact or contribute section), you grant permission for that content to be used, edited, and published on the website. You agree not to submit anything unlawful, harmful, or misleading.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '7. External Links', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'This website may include links to external websites for additional information. We are not responsible for the content, accuracy, or practices of those third-party sites.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '8. Limitation of Liability', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'The creator of this website is not liable for any direct, indirect, or consequential damages resulting from the use or inability to use the information provided on this site.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '9. Changes to These Terms', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'These Terms and Conditions may be updated at any time without notice. Continued use of the website means you accept any changes.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '10. Contact', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'If you have any questions about these Terms and Conditions, please contact:', 'legal-clarity' ); ?> <a href="mailto:lily.defendini@gmail.com">lily.defendini@gmail.com</a></p>
	</div>
</section>

<?php get_footer();
