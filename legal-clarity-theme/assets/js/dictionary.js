(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var input = document.getElementById('dict-search-input');
        var alphabet = document.getElementById('dict-alphabet');
        var noResults = document.getElementById('dict-no-results');
        var sections = Array.prototype.slice.call(document.querySelectorAll('.dict-section'));
        var terms = Array.prototype.slice.call(document.querySelectorAll('.dict-term'));

        if (!terms.length) {
            return;
        }

        var activeLetter = 'all';
        var debounceTimer = null;

        function applyFilters() {
            var query = input ? input.value.trim().toLowerCase() : '';
            var totalVisible = 0;
            var firstMatch = null;

            sections.forEach(function (section) {
                var letter = section.getAttribute('data-letter') || '';
                var letterMatches = (activeLetter === 'all') || (letter === activeLetter);
                var sectionVisibleCount = 0;

                var sectionTerms = section.querySelectorAll('.dict-term');
                Array.prototype.forEach.call(sectionTerms, function (term) {
                    var termText = term.getAttribute('data-term') || '';
                    var matchesLetter = letterMatches;
                    var matchesQuery = !query || termText.indexOf(query) !== -1;
                    var show = matchesLetter && matchesQuery;

                    if (show) {
                        term.hidden = false;
                        term.removeAttribute('hidden');
                        sectionVisibleCount++;
                        totalVisible++;
                        if (!firstMatch) {
                            firstMatch = term;
                        }
                    } else {
                        term.hidden = true;
                        term.setAttribute('hidden', '');
                    }
                });

                if (sectionVisibleCount === 0) {
                    section.hidden = true;
                    section.setAttribute('hidden', '');
                } else {
                    section.hidden = false;
                    section.removeAttribute('hidden');
                }
            });

            if (noResults) {
                if (totalVisible === 0) {
                    noResults.hidden = false;
                    noResults.removeAttribute('hidden');
                } else {
                    noResults.hidden = true;
                    noResults.setAttribute('hidden', '');
                }
            }

            return firstMatch;
        }

        function debouncedFilter() {
            if (debounceTimer) {
                clearTimeout(debounceTimer);
            }
            debounceTimer = setTimeout(applyFilters, 120);
        }

        if (input) {
            input.addEventListener('input', debouncedFilter);
        }

        if (alphabet) {
            var buttons = alphabet.querySelectorAll('button');
            Array.prototype.forEach.call(buttons, function (btn) {
                btn.addEventListener('click', function () {
                    Array.prototype.forEach.call(buttons, function (b) {
                        b.classList.remove('active');
                    });
                    btn.classList.add('active');

                    var letter = btn.getAttribute('data-letter') || 'all';
                    activeLetter = letter;

                    if (letter === 'all' && input) {
                        input.value = '';
                    }

                    applyFilters();
                });
            });
        }

        // Handle ?q= URL param on load.
        function getQueryParam(name) {
            var params = new URLSearchParams(window.location.search);
            return params.get(name);
        }

        var initialQ = getQueryParam('q');
        if (initialQ && input) {
            input.value = initialQ;
            var firstMatch = applyFilters();
            if (firstMatch && typeof firstMatch.scrollIntoView === 'function') {
                firstMatch.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        } else {
            applyFilters();
        }
    });
})();
