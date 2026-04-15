<?php
/**
 * Template Name: Citation Guide
 *
 * @package LegalClarity
 */
get_header(); ?>

<section class="page-hero">
	<div class="container-narrow">
		<p class="eyebrow"><?php echo esc_html__( 'Reference', 'legal-clarity' ); ?></p>
		<h1><?php echo esc_html__( 'Citation Guide', 'legal-clarity' ); ?></h1>
		<p class="lead"><?php echo esc_html__( 'To ensure accuracy, transparency, and credibility, all information on this website is based on reliable legal and governmental sources. This guide explains how sources are used and how content is developed.', 'legal-clarity' ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container-narrow prose">
		<h2><?php echo esc_html__( '1. Types of Sources Used', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'Content on this website may be based on:', 'legal-clarity' ); ?></p>
		<ul>
			<li><?php echo esc_html__( 'United States Constitution and amendments', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Federal and state statutes', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Supreme Court cases and other court decisions', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Government websites (such as Congress or federal agencies)', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Educational and legal reference materials', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Reputable academic or legal publications', 'legal-clarity' ); ?></li>
		</ul>
		<p><?php echo esc_html__( 'Whenever possible, primary sources are prioritized.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '2. How Information Is Presented', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'Legal concepts are translated into plain language to make them easier to understand. While wording may differ from original legal texts, the meaning and intent are preserved. Definitions and explanations are simplified, but they are grounded in established legal principles.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '3. Citation Format', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'Sources may be cited in a simplified format for clarity and accessibility. Examples:', 'legal-clarity' ); ?></p>
		<ul>
			<li><?php echo esc_html__( 'U.S. Const. amend. I', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Miranda v. Arizona, 384 U.S. 436 (1966)', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( '42 U.S.C. § 1983', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( '[Name of Government Website or Organization]', 'legal-clarity' ); ?></li>
		</ul>
		<p><?php echo esc_html__( 'Full legal citations may be shortened to improve readability for general audiences.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '4. Use of Case Law', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'When court cases are referenced, they are used to:', 'legal-clarity' ); ?></p>
		<ul>
			<li><?php echo esc_html__( 'Illustrate how legal principles are applied', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Provide real-world context', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Support definitions and explanations', 'legal-clarity' ); ?></li>
		</ul>
		<p><?php echo esc_html__( 'Case summaries are written in plain language and are not official court summaries.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '5. Contributions and Suggestions', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'Users may suggest edits, sources, or additions through the contact or contribute section. All submissions are reviewed before being incorporated to ensure accuracy and reliability.', 'legal-clarity' ); ?></p>

		<h2><?php echo esc_html__( '6. Limitations', 'legal-clarity' ); ?></h2>
		<p><?php echo esc_html__( 'Although care is taken to use accurate and reliable sources:', 'legal-clarity' ); ?></p>
		<ul>
			<li><?php echo esc_html__( 'This website is not a comprehensive legal database', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Information may be simplified for clarity', 'legal-clarity' ); ?></li>
			<li><?php echo esc_html__( 'Laws may change over time', 'legal-clarity' ); ?></li>
		</ul>
		<p><?php echo esc_html__( 'Users are encouraged to consult official sources or legal professionals for complete and current information.', 'legal-clarity' ); ?></p>
	</div>
</section>

<?php get_footer();
