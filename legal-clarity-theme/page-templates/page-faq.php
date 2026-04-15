<?php
/**
 * Template Name: FAQ
 *
 * @package LegalClarity
 */
get_header(); ?>

<section class="page-hero">
	<div class="container-narrow">
		<p class="eyebrow"><?php echo esc_html__( 'Help', 'legal-clarity' ); ?></p>
		<h1><?php echo esc_html__( 'Frequently Asked Questions', 'legal-clarity' ); ?></h1>
		<p class="lead"><?php echo esc_html__( 'Answers to common questions about The Legal Clarity Project and how to use this resource.', 'legal-clarity' ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container-narrow prose">
		<div class="faq-item">
			<h3><?php echo esc_html__( 'What is the purpose of this website?', 'legal-clarity' ); ?></h3>
			<p><?php echo esc_html__( 'This website is designed to make legal language easier to understand. It provides clear, plain-language explanations of legal terms, concepts, and rights so that anyone can feel more confident navigating legal information.', 'legal-clarity' ); ?></p>
		</div>

		<div class="faq-item">
			<h3><?php echo esc_html__( 'Is this website a source of legal advice?', 'legal-clarity' ); ?></h3>
			<p><?php echo esc_html__( 'No. The information on this website is for educational purposes only and should not be considered legal advice. For advice on a specific situation, you should consult a qualified attorney.', 'legal-clarity' ); ?></p>
		</div>

		<div class="faq-item">
			<h3><?php echo esc_html__( 'Who created this website?', 'legal-clarity' ); ?></h3>
			<p><?php echo esc_html__( 'This website was created as part of an initiative to improve access to legal knowledge and reduce confusion around complex legal terminology. You can find more about the creator in the About section of the website.', 'legal-clarity' ); ?></p>
		</div>

		<div class="faq-item">
			<h3><?php echo esc_html__( 'How are the definitions written?', 'legal-clarity' ); ?></h3>
			<p><?php echo esc_html__( 'Each definition is carefully simplified from real legal sources, including statutes, court cases, and legal references. The goal is to preserve the meaning while making the language more accessible.', 'legal-clarity' ); ?></p>
		</div>

		<div class="faq-item">
			<h3><?php echo esc_html__( 'Are the definitions completely accurate?', 'legal-clarity' ); ?></h3>
			<p><?php echo esc_html__( 'Every effort is made to ensure accuracy, but legal concepts can be complex and may vary depending on context or jurisdiction. The definitions are meant to be helpful summaries, not complete legal explanations.', 'legal-clarity' ); ?></p>
		</div>

		<div class="faq-item">
			<h3><?php echo esc_html__( 'Can I rely on this information for a legal situation?', 'legal-clarity' ); ?></h3>
			<p><?php echo esc_html__( 'You can use this website to better understand legal terms and concepts, but you should not rely on it alone when making legal decisions. Always seek professional legal guidance when needed.', 'legal-clarity' ); ?></p>
		</div>

		<div class="faq-item">
			<h3><?php echo esc_html__( 'Can I suggest a term or correction?', 'legal-clarity' ); ?></h3>
			<p><?php echo esc_html__( 'Yes. Suggestions, corrections, and contributions are welcome. You can submit ideas through the contact or contribute section of the website.', 'legal-clarity' ); ?></p>
		</div>

		<div class="faq-item">
			<h3><?php echo esc_html__( 'How often is the website updated?', 'legal-clarity' ); ?></h3>
			<p><?php echo esc_html__( 'Content is updated regularly as new terms are added and existing definitions are refined for clarity and accuracy.', 'legal-clarity' ); ?></p>
		</div>

		<div class="faq-item">
			<h3><?php echo esc_html__( 'Why is legal language so complicated?', 'legal-clarity' ); ?></h3>
			<p><?php echo esc_html__( 'Legal language is designed to be precise and consistent, but that often makes it difficult to understand. This website exists to bridge that gap by translating complex terms into everyday language.', 'legal-clarity' ); ?></p>
		</div>

		<div class="faq-item">
			<h3><?php echo esc_html__( 'What is the "Know Your Rights" section?', 'legal-clarity' ); ?></h3>
			<p><?php echo esc_html__( 'The "Know Your Rights" section provides simplified explanations of important rights, such as constitutional protections, so users can better understand their freedoms and protections.', 'legal-clarity' ); ?></p>
		</div>
	</div>
</section>

<?php get_footer();
