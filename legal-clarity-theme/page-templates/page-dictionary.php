<?php
/**
 * Template Name: Dictionary
 *
 * @package LegalClarity
 */

get_header();

$all_terms  = tlcp_get_dictionary_by_letter();
$initial_q  = isset( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
$available_letters = array_keys( $all_terms );
?>

<section class="page-hero">
    <div class="container">
        <div class="eyebrow">Legal Clarity Dictionary</div>
        <h1>The Legal Clarity Dictionary</h1>
        <p class="lead">A Plain-Language Guide to Legal Terms. Look up unfamiliar legal words and read simple, clear explanations — with real-world examples.</p>
    </div>
</section>

<section class="dict-controls">
    <div class="container">
        <form class="dict-search" onsubmit="return false;" role="search">
            <input
                type="search"
                id="dict-search-input"
                placeholder="Search terms, definitions, examples…"
                aria-label="Search the dictionary"
                value="<?php echo esc_attr( $initial_q ); ?>"
                autocomplete="off">
            <button type="submit" aria-label="Search"><?php echo tlcp_icon( 'search', 18 ); ?></button>
        </form>

        <div class="dict-alphabet" id="dict-alphabet" role="tablist" aria-label="Filter by letter">
            <button type="button" data-letter="all" class="active">All</button>
            <?php foreach ( range( 'A', 'Z' ) as $letter ) :
                $disabled = in_array( $letter, $available_letters, true ) ? '' : ' class="disabled" disabled';
            ?>
                <button type="button" data-letter="<?php echo esc_attr( $letter ); ?>"<?php echo $disabled; ?>><?php echo esc_html( $letter ); ?></button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section" id="dict-results">
    <div class="container">
        <?php if ( empty( $all_terms ) ) : ?>
            <div class="dict-empty">
                <h2>Dictionary content is loading</h2>
                <p class="lead" style="margin: 0 auto;">The dictionary data files will be populated as content is added.</p>
            </div>
        <?php else : ?>
            <?php foreach ( $all_terms as $letter => $terms ) : ?>
                <section class="dict-section" data-letter="<?php echo esc_attr( $letter ); ?>">
                    <h2 class="dict-letter-heading" id="letter-<?php echo esc_attr( strtolower( $letter ) ); ?>"><?php echo esc_html( $letter ); ?></h2>
                    <div class="dict-terms">
                        <?php foreach ( $terms as $term ) : ?>
                            <article class="dict-term" data-term="<?php echo esc_attr( strtolower( $term['term'] . ' ' . ( $term['definition'] ?? '' ) ) ); ?>">
                                <div class="dict-term-head">
                                    <span class="dict-term-name"><?php echo esc_html( $term['term'] ); ?></span>
                                    <?php if ( ! empty( $term['pos'] ) ) : ?>
                                        <span class="dict-term-pos">(<?php echo esc_html( $term['pos'] ); ?>)</span>
                                    <?php endif; ?>
                                </div>
                                <?php if ( ! empty( $term['definition'] ) ) : ?>
                                    <p class="dict-term-def"><?php echo esc_html( $term['definition'] ); ?></p>
                                <?php endif; ?>
                                <?php if ( ! empty( $term['example'] ) ) : ?>
                                    <p class="dict-term-example"><?php echo esc_html( $term['example'] ); ?></p>
                                <?php endif; ?>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>

            <div class="dict-empty" id="dict-no-results" hidden>
                <h2>No terms match your search</h2>
                <p class="lead" style="margin: 0 auto;">Try a different keyword or clear your filters.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
