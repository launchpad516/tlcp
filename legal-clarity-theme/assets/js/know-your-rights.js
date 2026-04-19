/**
 * Know Your Rights — tabbed UI interactions.
 *
 * Handles:
 *  - Horizontal scenario tabs
 *  - Vertical amendment tabs
 *  - "Read scenarios" card buttons that activate a tab + smooth scroll
 *  - "Related amendments" links that open the correct amendment tab
 *  - Keyboard navigation (Left/Right/Up/Down/Home/End)
 */
(function () {
    'use strict';

    // Swap no-js marker so CSS knows JS is active
    document.documentElement.classList.remove( 'no-js' );
    document.documentElement.classList.add( 'js' );

    /**
     * Wire up a single group of tabs defined by `[data-tabs]`.
     * Assumes:
     *  - role="tab" buttons have aria-controls pointing at panel ids
     *  - role="tabpanel" elements have id matching each tab's aria-controls
     *  - Initial active tab has class `is-active` and aria-selected="true"
     */
    function initTabGroup( group ) {
        var tabs   = Array.prototype.slice.call( group.querySelectorAll( '[role="tab"]' ) );
        var panels = Array.prototype.slice.call( group.querySelectorAll( '[role="tabpanel"]' ) );
        if ( ! tabs.length || ! panels.length ) { return; }

        function activate( targetId, focusTab ) {
            tabs.forEach( function ( tab ) {
                var controls = tab.getAttribute( 'aria-controls' );
                var isActive = controls === targetId;
                tab.setAttribute( 'aria-selected', isActive ? 'true' : 'false' );
                tab.setAttribute( 'tabindex', isActive ? '0' : '-1' );
                tab.classList.toggle( 'is-active', isActive );
                if ( isActive && focusTab ) {
                    tab.focus();
                    // Keep the tab visible inside a scrolling rail
                    if ( tab.scrollIntoView ) {
                        tab.scrollIntoView( { block: 'nearest', inline: 'nearest' } );
                    }
                }
            } );
            panels.forEach( function ( panel ) {
                panel.classList.toggle( 'is-active', panel.id === targetId );
            } );
        }

        tabs.forEach( function ( tab, idx ) {
            tab.addEventListener( 'click', function () {
                activate( tab.getAttribute( 'aria-controls' ), false );
            } );

            tab.addEventListener( 'keydown', function ( e ) {
                var orientation = group.querySelector( '[role="tablist"]' ).getAttribute( 'aria-orientation' );
                var isVertical  = orientation === 'vertical';
                var nextKeys    = isVertical ? [ 'ArrowDown' ] : [ 'ArrowRight' ];
                var prevKeys    = isVertical ? [ 'ArrowUp' ]   : [ 'ArrowLeft' ];

                var nextIdx = idx;
                if ( nextKeys.indexOf( e.key ) !== -1 ) {
                    nextIdx = ( idx + 1 ) % tabs.length;
                } else if ( prevKeys.indexOf( e.key ) !== -1 ) {
                    nextIdx = ( idx - 1 + tabs.length ) % tabs.length;
                } else if ( e.key === 'Home' ) {
                    nextIdx = 0;
                } else if ( e.key === 'End' ) {
                    nextIdx = tabs.length - 1;
                } else {
                    return;
                }

                e.preventDefault();
                activate( tabs[ nextIdx ].getAttribute( 'aria-controls' ), true );
            } );
        } );

        // Expose the activator so outside handlers can trigger it
        group._tlcpActivate = activate;
    }

    // Init every tab group on the page
    var tabGroups = document.querySelectorAll( '[data-tabs]' );
    tabGroups.forEach( initTabGroup );

    // Helpers to find a specific tab group
    function findGroup( name ) {
        for ( var i = 0; i < tabGroups.length; i++ ) {
            if ( tabGroups[ i ].getAttribute( 'data-tabs' ) === name ) {
                return tabGroups[ i ];
            }
        }
        return null;
    }

    function activateIn( groupName, targetId, scrollTo ) {
        var group = findGroup( groupName );
        if ( ! group || typeof group._tlcpActivate !== 'function' ) { return false; }
        group._tlcpActivate( targetId, false );
        if ( scrollTo ) {
            // Small delay so layout settles before scroll
            requestAnimationFrame( function () {
                var header = document.querySelector( '.site-header' );
                var offset = header ? header.getBoundingClientRect().height + 16 : 24;
                var y      = group.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo( { top: y, behavior: 'smooth' } );
            } );
        }
        return true;
    }

    // "Read scenarios" card buttons → activate matching scenario tab + scroll
    document.querySelectorAll( '.rights-card-link[data-scenario-target]' ).forEach( function ( link ) {
        link.addEventListener( 'click', function ( e ) {
            var slug = link.getAttribute( 'data-scenario-target' );
            if ( ! slug ) { return; }
            var handled = activateIn( 'scenarios', 'scenario-panel-' + slug, true );
            if ( handled ) { e.preventDefault(); }
        } );
    } );

    // "Related amendments" inline links → open that amendment tab
    document.querySelectorAll( 'a[data-amendment-target]' ).forEach( function ( link ) {
        link.addEventListener( 'click', function ( e ) {
            var num = link.getAttribute( 'data-amendment-target' );
            if ( ! num ) { return; }
            var handled = activateIn( 'amendments', 'amendment-panel-' + num, true );
            if ( handled ) { e.preventDefault(); }
        } );
    } );

    // Deep-linking: if URL hash matches a panel id, activate it
    if ( window.location.hash ) {
        var hashId = window.location.hash.slice( 1 );
        if ( hashId.indexOf( 'scenario-panel-' ) === 0 ) {
            activateIn( 'scenarios', hashId, false );
        } else if ( hashId.indexOf( 'amendment-panel-' ) === 0 ) {
            activateIn( 'amendments', hashId, false );
        }
    }
})();
