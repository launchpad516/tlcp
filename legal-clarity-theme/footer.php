<?php
/**
 * Site Footer
 *
 * @package LegalClarity
 */
?>
</main>

<footer class="site-footer">
    <div class="container">
        <div class="footer-main">
            <div class="footer-brand">
                <?php echo tlcp_logo_html(); ?>
                <p>Making legal language clear and accessible to everyone. A plain-language reference created by Lily Defendini.</p>
            </div>

            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/dictionary/' ) ); ?>">Dictionary</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/know-your-rights/' ) ); ?>">Know Your Rights</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">Insights</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>About</h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contribute/' ) ); ?>">Contribute</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/citation-guide/' ) ); ?>">Citation Guide</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Legal</h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/terms-and-conditions/' ) ); ?>">Terms &amp; Conditions</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/accessibility/' ) ); ?>">Accessibility</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div>© <?php echo date( 'Y' ); ?> Lily Defendini. All rights reserved. This website uses secure HTTPS encryption.</div>
            <div class="footer-socials">
                <a href="#" aria-label="Twitter"><?php echo tlcp_icon( 'twitter', 18 ); ?></a>
                <a href="#" aria-label="Facebook"><?php echo tlcp_icon( 'facebook', 18 ); ?></a>
                <a href="#" aria-label="LinkedIn"><?php echo tlcp_icon( 'linkedin', 18 ); ?></a>
                <a href="#" aria-label="YouTube"><?php echo tlcp_icon( 'youtube', 18 ); ?></a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
