<?php
/**
 * Contact / Contribute form handler.
 *
 * @package LegalClarity
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'TLCP_CONTACT_EMAIL', 'lily.defendini@gmail.com' );

/**
 * Handle contact / contribute / suggest a term form submissions.
 */
function tlcp_handle_form_submission() {
    if ( empty( $_POST['tlcp_form_action'] ) ) { return; }

    if ( ! isset( $_POST['tlcp_nonce'] ) || ! wp_verify_nonce( $_POST['tlcp_nonce'], 'tlcp_form' ) ) {
        wp_die( 'Security check failed.' );
    }

    $action  = sanitize_key( $_POST['tlcp_form_action'] );
    $name    = isset( $_POST['name'] )    ? sanitize_text_field( $_POST['name'] )    : '';
    $email   = isset( $_POST['email'] )   ? sanitize_email( $_POST['email'] )        : '';
    $subject = isset( $_POST['subject'] ) ? sanitize_text_field( $_POST['subject'] ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( $_POST['message'] ) : '';
    $term    = isset( $_POST['term'] )    ? sanitize_text_field( $_POST['term'] )    : '';
    $source  = isset( $_POST['source'] )  ? sanitize_text_field( $_POST['source'] )  : '';

    // Honeypot.
    if ( ! empty( $_POST['website'] ) ) { return; }

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_safe_redirect( add_query_arg( 'tlcp_error', '1', wp_get_referer() ) );
        exit;
    }

    $to = TLCP_CONTACT_EMAIL;

    switch ( $action ) {
        case 'suggest_term':
            $email_subject = '[TLCP] Term Suggestion: ' . $term;
            $body  = "A new term suggestion has been submitted.\n\n";
            $body .= "From: $name <$email>\n";
            $body .= "Term: $term\n";
            $body .= "Where encountered: $source\n\n";
            $body .= "Message:\n$message\n";
            break;
        case 'contribute':
            $email_subject = '[TLCP] Contribution: ' . $subject;
            $body  = "A new contribution has been submitted.\n\n";
            $body .= "From: $name <$email>\n";
            $body .= "Topic: $subject\n\n";
            $body .= "Message:\n$message\n";
            break;
        case 'contact':
        default:
            $email_subject = '[TLCP] Contact: ' . ( $subject ? $subject : 'New message' );
            $body  = "A new contact message has been submitted.\n\n";
            $body .= "From: $name <$email>\n";
            $body .= "Subject: $subject\n\n";
            $body .= "Message:\n$message\n";
            break;
    }

    $headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
    wp_mail( $to, $email_subject, $body, $headers );

    wp_safe_redirect( add_query_arg( 'tlcp_success', '1', wp_get_referer() ) );
    exit;
}
add_action( 'admin_post_tlcp_submit', 'tlcp_handle_form_submission' );
add_action( 'admin_post_nopriv_tlcp_submit', 'tlcp_handle_form_submission' );
