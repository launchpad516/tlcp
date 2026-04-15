<?php
/**
 * Template Name: Accessibility Statement
 *
 * @package LegalClarity
 */
get_header(); ?>

<section class="page-hero">
	<div class="container-narrow">
		<p class="eyebrow"><?php echo esc_html__( 'Accessibility', 'legal-clarity' ); ?></p>
		<h1><?php echo esc_html__( 'Accessibility Statement', 'legal-clarity' ); ?></h1>
		<p class="lead"><?php echo esc_html__( 'This website is committed to making legal information accessible, clear, and usable for all individuals.', 'legal-clarity' ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container-narrow prose">
		<h2><?php echo esc_html__( 'Our Commitment', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'This website aims to follow accessibility best practices based on widely accepted guidelines, including the WCAG 2.1 and WCAG 2.2. Our goal is to create a user-friendly experience that supports a wide range of abilities and technologies.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( 'Accessibility Features', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'To support accessibility, this website is designed with:', 'legal-clarity' ); ?></p>
		<ul>
			<li><?php echo esc_html__( 'Clear and simple language to improve understanding', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Structured headings to organize content', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Readable fonts and high-contrast text', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Logical page layouts for easy navigation', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Descriptive text for images when applicable', 'legal-clarity' ); ?></li>
		</ul>

		<h2><?php echo esc_html__( 'Ongoing Improvements', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'Accessibility is an ongoing effort. We are continually working to improve the usability and accessibility of this website as new standards and feedback emerge.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( 'Feedback', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'If you experience difficulty accessing any part of this website or have suggestions for improvement, we encourage you to reach out. Your feedback is important and helps make this resource better for everyone.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( 'Contact', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'If you have any questions or accessibility concerns, please contact:', 'legal-clarity' ); ?> <a href="mailto:lily.defendini@gmail.com">lily.defendini@gmail.com</a></p>
	</div>
</section>

<?php get_footer();
