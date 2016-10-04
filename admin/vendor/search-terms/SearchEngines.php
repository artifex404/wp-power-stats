<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

/**
 * Search Engine database
 *
 * ======================================
 * HOW TO ADD A SEARCH ENGINE TO THE LIST
 * ======================================
 * If you want to add a new entry, please email us the information + icon at
 * hello at piwik.org
 *
 * See also: http://piwik.org/faq/general/#faq_39
 *
 * Detail of a line:
 * Url => array( SearchEngineName, KeywordParameter, [path containing the keyword], [charset used by the search engine])
 *
 * The main search engine URL has to be at the top of the list for the given
 * search Engine.  This serves as the master record so additional URLs
 * don't have to duplicate all the information, but can override when needed.
 *
 * The URL, "example.com", will match "example.com", "m.example.com",
 * "www.example.com", and "search.example.com".
 *
 * For region-specific search engines, the URL, "{}.example.com" will match
 * any ISO3166-1 alpha2 country code against "{}".  Similarly, "example.{}"
 * will match against valid country TLDs, but should be used sparingly to
 * avoid false positives.
 *
 * The charset should be an encoding supported by mbstring.  If unspecified,
 * we'll assume it's UTF-8.
 * Reference: http://www.php.net/manual/en/mbstring.encodings.php
 *
 * You can add new search engines icons by adding the icon in the
 * plugins/Referrers/images/searchEngines directory using the format
 * 'mainSearchEngineUrl.png'. Example: www.google.com.png
 *
 * To help Piwik link directly the search engine result page for the keyword,
 * specify the third entry in the array using the macro {k} that will
 * automatically be replaced by the keyword.
 *
 * A simple example is:
 *  'www.google.com'        => array('Google', 'q', 'search?q={k}'),
 *
 * A more complicated example, with an array of possible variable names, and a custom charset:
 *  'www.baidu.com'            => array('Baidu', array('wd', 'word', 'kw'), 's?wd={k}', 'gb2312'),
 *
 * Another example using a regular expression to parse the path for keywords:
 *  'infospace.com'         => array('InfoSpace', array('/dir1\/(pattern)\/dir2/'), '/dir1/{k}/dir2/stuff/'),
 */
if (!isset($GLOBALS['PowerStats_SearchEngines'])) {
    $GLOBALS['PowerStats_SearchEngines'] = array (
            '1.cz' =>
                array (
                    0 => '1.cz',
                    1 =>
                        array (
                            0 => '/s\\/([^\\/]+)/',
                            1 => 'q',
                        ),
                    2 => 's/{k}',
                    3 =>
                        array (
                            0 => 'iso-8859-2',
                        ),
                ),
            'www.123people.com' =>
                array (
                    0 => '123people',
                    1 =>
                        array (
                            0 => '/s\\/([^\\/]+)/',
                            1 => 'search_term',
                        ),
                    2 => 's/{k}',
                ),
            '123people.{}' =>
                array (
                    0 => '123people',
                    1 =>
                        array (
                            0 => '/s\\/([^\\/]+)/',
                            1 => 'search_term',
                        ),
                    2 => 's/{k}',
                ),
            'so.360.cn' =>
                array (
                    0 => '360search',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 's?q={k}',
                    3 =>
                        array (
                            0 => 'UTF-8',
                            1 => 'gb2312',
                        ),
                ),
            'www.abacho.de' =>
                array (
                    0 => 'Abacho',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'suche?q={k}',
                ),
            'www.abacho.com' =>
                array (
                    0 => 'Abacho',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'suche?q={k}',
                ),
            'www.abacho.co.uk' =>
                array (
                    0 => 'Abacho',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'suche?q={k}',
                ),
            'www.se.abacho.com' =>
                array (
                    0 => 'Abacho',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'suche?q={k}',
                ),
            'www.tr.abacho.com' =>
                array (
                    0 => 'Abacho',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'suche?q={k}',
                ),
            'www.abacho.at' =>
                array (
                    0 => 'Abacho',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'suche?q={k}',
                ),
            'www.abacho.fr' =>
                array (
                    0 => 'Abacho',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'suche?q={k}',
                ),
            'www.abacho.es' =>
                array (
                    0 => 'Abacho',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'suche?q={k}',
                ),
            'www.abacho.ch' =>
                array (
                    0 => 'Abacho',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'suche?q={k}',
                ),
            'www.abacho.it' =>
                array (
                    0 => 'Abacho',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'suche?q={k}',
                ),
            'abcsok.no' =>
                array (
                    0 => 'ABCsøk',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'verden.abcsok.no' =>
                array (
                    0 => 'ABCsøk',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'www.acoon.de' =>
                array (
                    0 => 'Acoon',
                    1 =>
                        array (
                            0 => 'begriff',
                        ),
                    2 => 'cgi-bin/search.exe?begriff={k}',
                ),
            'chercherfr.aguea.com' =>
                array (
                    0 => 'Aguea',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 's.py?q={k}',
                ),
            'alexa.com' =>
                array (
                    0 => 'Alexa',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'search.toolbars.alexa.com' =>
                array (
                    0 => 'Alexa',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'rechercher.aliceadsl.fr' =>
                array (
                    0 => 'Alice Adsl',
                    1 =>
                        array (
                            0 => 'qs',
                        ),
                    2 => 'google.pl?qs={k}',
                ),
            'all.by' =>
                array (
                    0 => 'All.by',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'cgi-bin/search.cgi?mode=by&query={k}',
                ),
            'www.allesklar.de' =>
                array (
                    0 => 'Allesklar',
                    1 =>
                        array (
                            0 => 'words',
                        ),
                    2 => '?words={k}',
                ),
            'www.allesklar.at' =>
                array (
                    0 => 'Allesklar',
                    1 =>
                        array (
                            0 => 'words',
                        ),
                    2 => '?words={k}',
                ),
            'www.allesklar.ch' =>
                array (
                    0 => 'Allesklar',
                    1 =>
                        array (
                            0 => 'words',
                        ),
                    2 => '?words={k}',
                ),
            'www.alltheweb.com' =>
                array (
                    0 => 'AllTheWeb',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'www.altavista.com' =>
                array (
                    0 => 'AltaVista',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/results?q={k}',
                ),
            'search.altavista.com' =>
                array (
                    0 => 'AltaVista',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/results?q={k}',
                ),
            'listings.altavista.com' =>
                array (
                    0 => 'AltaVista',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/results?q={k}',
                ),
            'altavista.de' =>
                array (
                    0 => 'AltaVista',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/results?q={k}',
                ),
            'altavista.fr' =>
                array (
                    0 => 'AltaVista',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/results?q={k}',
                ),
            '{}.altavista.com' =>
                array (
                    0 => 'AltaVista',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/results?q={k}',
                ),
            'be-nl.altavista.com' =>
                array (
                    0 => 'AltaVista',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/results?q={k}',
                ),
            'be-fr.altavista.com' =>
                array (
                    0 => 'AltaVista',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/results?q={k}',
                ),
            'search.aol.com' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'search.aol.it' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'aolsearch.aol.com' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'www.aolrecherche.aol.fr' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'www.aolrecherches.aol.fr' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'www.aolimages.aol.fr' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'aim.search.aol.com' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'www.recherche.aol.fr' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'recherche.aol.fr' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'find.web.aol.com' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'recherche.aol.ca' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'aolsearch.aol.co.uk' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'search.aol.co.uk' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'aolrecherche.aol.fr' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'sucheaol.aol.de' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'suche.aol.de' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'o2suche.aol.de' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'suche.aolsvc.de' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'aolbusqueda.aol.com.mx' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'alicesuche.aol.de' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'alicesuchet.aol.de' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'suchet2.aol.de' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'search.hp.my.aol.com.au' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'search.hp.my.aol.de' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'search.hp.my.aol.it' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'search-intl.netscape.com' =>
                array (
                    0 => 'AOL',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'q',
                        ),
                    2 => 'aol/search?q={k}',
                ),
            'apollo.lv/portal/search/' =>
                array (
                    0 => 'Apollo lv',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?cof=FORID%3A11&q={k}&search_where=www',
                ),
            'apollo7.de' =>
                array (
                    0 => 'Apollo7',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'a7db/index.php?query={k}&de_sharelook=true&de_bing=true&de_witch=true&de_google=true&de_yahoo=true&de_lycos=true',
                ),
            'sm.aport.ru' =>
                array (
                    0 => 'Aport',
                    1 =>
                        array (
                            0 => 'r',
                        ),
                    2 => 'search?r={k}',
                ),
            'arama.com' =>
                array (
                    0 => 'Arama',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search.php3?q={k}',
                ),
            'www.arcor.de' =>
                array (
                    0 => 'Arcor',
                    1 =>
                        array (
                            0 => 'Keywords',
                        ),
                    2 => 'content/searchresult.jsp?Keywords={k}',
                ),
            'arianna.libero.it' =>
                array (
                    0 => 'Arianna',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search/abin/integrata.cgi?query={k}',
                ),
            'www.arianna.com' =>
                array (
                    0 => 'Arianna',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search/abin/integrata.cgi?query={k}',
                ),
            'ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'web.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'int.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'mws.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'images.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'images.{}.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'ask.reference.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'www.askkids.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'iwon.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'www.ask.co.uk' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            '{}.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'www.qbyrd.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            '{}.qbyrd.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'www.search-results.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'www1.search-results.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'int.search-results.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            '{}.search-results.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'search.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            '{}.search.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'avira-int.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'searchqu.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'search.tb.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'nortonsafe.search.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'safesearch.avira.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'avira.search.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'int.search.tb.ask.com' =>
                array (
                    0 => 'Ask',
                    1 =>
                        array (
                            0 => 'ask',
                            1 => 'q',
                            2 => 'searchfor',
                        ),
                    2 => 'web?q={k}',
                ),
            'searchatlas.centrum.cz' =>
                array (
                    0 => 'Atlas',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'search.auone.jp' =>
                array (
                    0 => 'auone',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'sp-search.auone.jp' =>
                array (
                    0 => 'auone',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'sp-image.search.auone.jp' =>
                array (
                    0 => 'auone Images',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'www2.austronaut.at' =>
                array (
                    0 => 'Austronaut',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'www1.austronaut.at' =>
                array (
                    0 => 'Austronaut',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'search.babylon.com' =>
                array (
                    0 => 'Babylon',
                    1 =>
                        array (
                            0 => 'q',
                            1 => '/\\/web\\/(.*)/',
                        ),
                    2 => '?q={k}',
                ),
            'searchassist.babylon.com' =>
                array (
                    0 => 'Babylon',
                    1 =>
                        array (
                            0 => 'q',
                            1 => '/\\/web\\/(.*)/',
                        ),
                    2 => '?q={k}',
                ),
            'www.baidu.com' =>
                array (
                    0 => 'Baidu',
                    1 =>
                        array (
                            0 => 'wd',
                            1 => 'word',
                            2 => 'kw',
                        ),
                    2 => 's?wd={k}',
                    3 =>
                        array (
                            0 => 'UTF-8',
                            1 => 'gb2312',
                        ),
                ),
            'www1.baidu.com' =>
                array (
                    0 => 'Baidu',
                    1 =>
                        array (
                            0 => 'wd',
                            1 => 'word',
                            2 => 'kw',
                        ),
                    2 => 's?wd={k}',
                    3 =>
                        array (
                            0 => 'UTF-8',
                            1 => 'gb2312',
                        ),
                ),
            'm.baidu.com' =>
                array (
                    0 => 'Baidu',
                    1 =>
                        array (
                            0 => 'wd',
                            1 => 'word',
                            2 => 'kw',
                        ),
                    2 => 's?wd={k}',
                    3 =>
                        array (
                            0 => 'UTF-8',
                            1 => 'gb2312',
                        ),
                ),
            'www.baidu.co.th' =>
                array (
                    0 => 'Baidu',
                    1 =>
                        array (
                            0 => 'wd',
                            1 => 'word',
                            2 => 'kw',
                        ),
                    2 => 's?wd={k}',
                    3 =>
                        array (
                            0 => 'UTF-8',
                            1 => 'gb2312',
                        ),
                ),
            'zhidao.baidu.com' =>
                array (
                    0 => 'Baidu',
                    1 =>
                        array (
                            0 => 'wd',
                            1 => 'word',
                            2 => 'kw',
                        ),
                    2 => 's?wd={k}',
                    3 =>
                        array (
                            0 => 'UTF-8',
                            1 => 'gb2312',
                        ),
                ),
            'tieba.baidu.com' =>
                array (
                    0 => 'Baidu',
                    1 =>
                        array (
                            0 => 'wd',
                            1 => 'word',
                            2 => 'kw',
                        ),
                    2 => 's?wd={k}',
                    3 =>
                        array (
                            0 => 'UTF-8',
                            1 => 'gb2312',
                        ),
                ),
            'news.baidu.com' =>
                array (
                    0 => 'Baidu',
                    1 =>
                        array (
                            0 => 'wd',
                            1 => 'word',
                            2 => 'kw',
                        ),
                    2 => 's?wd={k}',
                    3 =>
                        array (
                            0 => 'UTF-8',
                            1 => 'gb2312',
                        ),
                ),
            'cgi.search.biglobe.ne.jp' =>
                array (
                    0 => 'Biglobe',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'cgi-bin/search-st?q={k}',
                ),
            'images.search.biglobe.ne.jp' =>
                array (
                    0 => 'Biglobe Images',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'cgi-bin/search-st?q={k}',
                ),
            'bing.com' =>
                array (
                    0 => 'Bing',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'Q',
                        ),
                    2 => 'search?q={k}',
                ),
            '{}.bing.com' =>
                array (
                    0 => 'Bing',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'Q',
                        ),
                    2 => 'search?q={k}',
                ),
            'msnbc.msn.com' =>
                array (
                    0 => 'Bing',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'Q',
                        ),
                    2 => 'search?q={k}',
                ),
            'dizionario.it.msn.com' =>
                array (
                    0 => 'Bing',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'Q',
                        ),
                    2 => 'search?q={k}',
                ),
            'enciclopedia.it.msn.com' =>
                array (
                    0 => 'Bing',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'Q',
                        ),
                    2 => 'search?q={k}',
                ),
            'cc.bingj.com' =>
                array (
                    0 => 'Bing',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'Q',
                        ),
                    2 => 'search?q={k}',
                ),
            'bing.com/images/search' =>
                array (
                    0 => 'Bing Images',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'Q',
                        ),
                    2 => '?q={k}',
                ),
            '{}.bing.com/images/search' =>
                array (
                    0 => 'Bing Images',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'Q',
                        ),
                    2 => '?q={k}',
                ),
            'blekko.com' =>
                array (
                    0 => 'blekko',
                    1 =>
                        array (
                            0 => 'q',
                            1 => '/\\/ws\\/(.*)/',
                        ),
                    2 => 'ws/{k}',
                ),
            'www.blogdigger.com' =>
                array (
                    0 => 'Blogdigger',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'www.blogpulse.com' =>
                array (
                    0 => 'Blogpulse',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search?query={k}',
                ),
            'search.bluewin.ch' =>
                array (
                    0 => 'Bluewin',
                    1 =>
                        array (
                            0 => 'searchTerm',
                            1 => 'q',
                        ),
                    2 => 'v2/index.php?q={k}',
                ),
            'web.canoe.ca' =>
                array (
                    0 => 'Canoe.ca',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'search.centrum.cz' =>
                array (
                    0 => 'Centrum',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'morfeo.centrum.cz' =>
                array (
                    0 => 'Centrum',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'www.charter.net' =>
                array (
                    0 => 'Charter',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/index.php?q={k}',
                ),
            'claro-search.com' =>
                array (
                    0 => 'Claro Search',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'pesquisa.clix.pt' =>
                array (
                    0 => 'Clix',
                    1 =>
                        array (
                            0 => 'question',
                        ),
                    2 => 'resultado.html?in=Mundial&question={k}',
                ),
            'search.comcast.net' =>
                array (
                    0 => 'Comcast',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'websearch.cs.com' =>
                array (
                    0 => 'Compuserve.com (Enhanced by Google)',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'cs/search?query={k}',
                ),
            'search.conduit.com' =>
                array (
                    0 => 'Conduit.com',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'Results.aspx?q={k}',
                ),
            'images.search.conduit.com' =>
                array (
                    0 => 'Conduit.com',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'Results.aspx?q={k}',
                ),
            'www.crawler.com' =>
                array (
                    0 => 'Crawler',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/results1.aspx?q={k}',
                ),
            'www.cuil.com' =>
                array (
                    0 => 'Cuil',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'daemon-search.com' =>
                array (
                    0 => 'Daemon search',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'explore/web?q={k}',
                ),
            'my.daemon-search.com' =>
                array (
                    0 => 'Daemon search',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'explore/web?q={k}',
                ),
            'www.dasoertliche.de' =>
                array (
                    0 => 'DasOertliche',
                    1 =>
                        array (
                            0 => 'kw',
                        ),
                ),
            'www1.dastelefonbuch.de' =>
                array (
                    0 => 'DasTelefonbuch',
                    1 =>
                        array (
                            0 => 'kw',
                        ),
                ),
            'search.daum.net' =>
                array (
                    0 => 'Daum',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'otsing.delfi.ee' =>
                array (
                    0 => 'Delfi EE',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'find?q={k}',
                ),
            'smart.delfi.lv' =>
                array (
                    0 => 'Delfi lv',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'find?q={k}',
                ),
            'digg.com' =>
                array (
                    0 => 'Digg',
                    1 =>
                        array (
                            0 => 's',
                        ),
                    2 => 'search?s={k}',
                ),
            'fr.dir.com' =>
                array (
                    0 => 'dir.com',
                    1 =>
                        array (
                            0 => 'req',
                        ),
                ),
            'dmoz.org' =>
                array (
                    0 => 'dmoz',
                    1 =>
                        array (
                            0 => 'search',
                        ),
                ),
            'editors.dmoz.org' =>
                array (
                    0 => 'dmoz',
                    1 =>
                        array (
                            0 => 'search',
                        ),
                ),
            'duckduckgo.com' =>
                array (
                    0 => 'DuckDuckGo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'r.duckduckgo.com' =>
                array (
                    0 => 'DuckDuckGo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'search.earthlink.net' =>
                array (
                    0 => 'Earthlink',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'ecosia.org' =>
                array (
                    0 => 'Ecosia',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search.php?q={k}',
                ),
            'ariadna.elmundo.es' =>
                array (
                    0 => 'El Mundo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'www.eniro.se' =>
                array (
                    0 => 'Eniro',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'search_word',
                        ),
                    2 => 'query?q={k}',
                ),
            'eo.st' =>
                array (
                    0 => 'eo',
                    1 =>
                        array (
                            0 => 'x_query',
                        ),
                    2 => 'cgi-bin/eolost.cgi?x_query={k}',
                ),
            'www.eurip.com' =>
                array (
                    0 => 'Eurip',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/?q={k}',
                ),
            'www.euroseek.com' =>
                array (
                    0 => 'Euroseek',
                    1 =>
                        array (
                            0 => 'string',
                        ),
                    2 => 'system/search.cgi?string={k}',
                ),
            'www.everyclick.com' =>
                array (
                    0 => 'Everyclick',
                    1 =>
                        array (
                            0 => 'keyword',
                        ),
                ),
            'www.exalead.fr' =>
                array (
                    0 => 'Exalead',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/results?q={k}',
                ),
            'www.exalead.com' =>
                array (
                    0 => 'Exalead',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/results?q={k}',
                ),
            'search.excite.it' =>
                array (
                    0 => 'Excite',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/?q={k}',
                ),
            'search.excite.fr' =>
                array (
                    0 => 'Excite',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/?q={k}',
                ),
            'search.excite.de' =>
                array (
                    0 => 'Excite',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/?q={k}',
                ),
            'search.excite.co.uk' =>
                array (
                    0 => 'Excite',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/?q={k}',
                ),
            'search.excite.es' =>
                array (
                    0 => 'Excite',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/?q={k}',
                ),
            'search.excite.nl' =>
                array (
                    0 => 'Excite',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/?q={k}',
                ),
            'www.facebook.com' =>
                array (
                    0 => 'Facebook',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/?q={k}',
                ),
            'www.fastbrowsersearch.com' =>
                array (
                    0 => 'Fast Browser Search',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'results/results.aspx?q={k}',
                ),
            'www.findhurtig.dk' =>
                array (
                    0 => 'Findhurtig',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web?q={k}',
                ),
            'www.fireball.de' =>
                array (
                    0 => 'Fireball',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'ajax.asp?q={k}',
                ),
            'www.firstsfind.com' =>
                array (
                    0 => 'Firstsfind',
                    1 =>
                        array (
                            0 => 'qry',
                        ),
                ),
            'www.fixsuche.de' =>
                array (
                    0 => 'Fixsuche',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'www.flix.de' =>
                array (
                    0 => 'Flix.de',
                    1 =>
                        array (
                            0 => 'keyword',
                        ),
                ),
            'search.fooooo.com' =>
                array (
                    0 => 'Fooooo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web/?q={k}',
                ),
            'forestle.org' =>
                array (
                    0 => 'Forestle',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search.php?q={k}',
                ),
            '{}.forestle.org' =>
                array (
                    0 => 'Forestle',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search.php?q={k}',
                ),
            'forestle.mobi' =>
                array (
                    0 => 'Forestle',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search.php?q={k}',
                ),
            'recherche.francite.com' =>
                array (
                    0 => 'Francite',
                    1 =>
                        array (
                            0 => 'name',
                        ),
                ),
            'search.free.fr' =>
                array (
                    0 => 'Free',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'qs',
                        ),
                ),
            'search1-2.free.fr' =>
                array (
                    0 => 'Free',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'qs',
                        ),
                ),
            'search1-1.free.fr' =>
                array (
                    0 => 'Free',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'qs',
                        ),
                ),
            'search.freecause.com' =>
                array (
                    0 => 'FreeCause',
                    1 =>
                        array (
                            0 => 'p',
                        ),
                    2 => '?p={k}',
                ),
            'suche.freenet.de' =>
                array (
                    0 => 'Freenet',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'Keywords',
                        ),
                    2 => 'suche/?query={k}',
                ),
            'friendfeed.com' =>
                array (
                    0 => 'FriendFeed',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'gais.cs.ccu.edu.tw' =>
                array (
                    0 => 'GAIS',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search.php?q={k}',
                ),
            'search.genieo.com' =>
                array (
                    0 => 'Genieo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '&q={k}',
                ),
            'geona.net' =>
                array (
                    0 => 'Geona',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'www.gigablast.com' =>
                array (
                    0 => 'Gigablast',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'dir.gigablast.com' =>
                array (
                    0 => 'Gigablast (Directory)',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'www.gnadenmeer.de' =>
                array (
                    0 => 'Gnadenmeer',
                    1 =>
                        array (
                            0 => 'keyword',
                        ),
                ),
            'www.gomeo.com' =>
                array (
                    0 => 'Gomeo',
                    1 =>
                        array (
                            0 => 'Keywords',
                            1 => '/\\/search\\/([^\\/]+)/',
                        ),
                    2 => '/search/{k}',
                ),
            'search.goo.ne.jp' =>
                array (
                    0 => 'goo',
                    1 =>
                        array (
                            0 => 'MT',
                        ),
                    2 => 'web.jsp?MT={k}',
                ),
            'ocnsearch.goo.ne.jp' =>
                array (
                    0 => 'goo',
                    1 =>
                        array (
                            0 => 'MT',
                        ),
                    2 => 'web.jsp?MT={k}',
                ),
            'google.com' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'google.{}' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'www2.google.com' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'ipv6.google.com' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'go.google.com' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'wwwgoogle.com' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'wwwgoogle.{}' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'gogole.com' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'gogole.{}' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'gppgle.com' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'gppgle.{}' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'googel.com' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'googel.{}' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'search.avg.com' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'isearch.avg.com' =>
                array (
                    0 => 'Google',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'blogsearch.google.com' =>
                array (
                    0 => 'Google Blogsearch',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'blogsearch?q={k}',
                ),
            'blogsearch.google.{}' =>
                array (
                    0 => 'Google Blogsearch',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'blogsearch?q={k}',
                ),
            'google.com/cse' =>
                array (
                    0 => 'Google Custom Search',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'query',
                        ),
                ),
            'google.{}/cse' =>
                array (
                    0 => 'Google Custom Search',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'query',
                        ),
                ),
            'google.com/custom' =>
                array (
                    0 => 'Google Custom Search',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'query',
                        ),
                ),
            'google.{}/custom' =>
                array (
                    0 => 'Google Custom Search',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'query',
                        ),
                ),
            'images.google.com' =>
                array (
                    0 => 'Google Images',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'images?q={k}',
                ),
            'images.google.{}' =>
                array (
                    0 => 'Google Images',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'images?q={k}',
                ),
            'maps.google.com' =>
                array (
                    0 => 'Google Maps',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'maps?q={k}',
                ),
            'maps.google.{}' =>
                array (
                    0 => 'Google Maps',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'maps?q={k}',
                ),
            'news.google.com' =>
                array (
                    0 => 'Google News',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'news.google.{}' =>
                array (
                    0 => 'Google News',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'scholar.google.com' =>
                array (
                    0 => 'Google Scholar',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'scholar?q={k}',
                ),
            'scholar.google.{}' =>
                array (
                    0 => 'Google Scholar',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'scholar?q={k}',
                ),
            'google.com/products' =>
                array (
                    0 => 'Google Shopping',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}&tbm=shop',
                ),
            'google.{}/products' =>
                array (
                    0 => 'Google Shopping',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}&tbm=shop',
                ),
            'encrypted.google.com' =>
                array (
                    0 => 'Google SSL',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'googlesyndicatedsearch.com' =>
                array (
                    0 => 'Google syndicated search',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'translate.google.com' =>
                array (
                    0 => 'Google Translations',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'video.google.com' =>
                array (
                    0 => 'Google Video',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}&tbm=vid',
                ),
            'www.goyellow.de' =>
                array (
                    0 => 'GoYellow.de',
                    1 =>
                        array (
                            0 => 'MDN',
                        ),
                ),
            'www.gulesider.no' =>
                array (
                    0 => 'Gule Sider',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'www.haosou.com' =>
                array (
                    0 => 'Haosou',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 's?q={k}',
                ),
            'www.highbeam.com' =>
                array (
                    0 => 'HighBeam',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'Search.aspx?q={k}',
                ),
            'req.hit-parade.com' =>
                array (
                    0 => 'Hit-Parade',
                    1 =>
                        array (
                            0 => 'p7',
                        ),
                    2 => 'general/recherche.asp?p7={k}',
                ),
            'class.hit-parade.com' =>
                array (
                    0 => 'Hit-Parade',
                    1 =>
                        array (
                            0 => 'p7',
                        ),
                    2 => 'general/recherche.asp?p7={k}',
                ),
            'www.hit-parade.com' =>
                array (
                    0 => 'Hit-Parade',
                    1 =>
                        array (
                            0 => 'p7',
                        ),
                    2 => 'general/recherche.asp?p7={k}',
                ),
            'holmes.ge' =>
                array (
                    0 => 'Holmes',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search.htm?q={k}',
                ),
            'www.hooseek.com' =>
                array (
                    0 => 'Hooseek',
                    1 =>
                        array (
                            0 => 'recherche',
                        ),
                    2 => 'web?recherche={k}',
                ),
            'www.hotbot.com' =>
                array (
                    0 => 'Hotbot',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'start.iplay.com' =>
                array (
                    0 => 'I-play',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'searchresults.aspx?q={k}',
                ),
            'blogs.icerocket.com' =>
                array (
                    0 => 'Icerocket',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'www.icq.com' =>
                array (
                    0 => 'ICQ',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/results.php?q={k}',
                ),
            'search.icq.com' =>
                array (
                    0 => 'ICQ',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/results.php?q={k}',
                ),
            'www.ilse.nl' =>
                array (
                    0 => 'Ilse NL',
                    1 =>
                        array (
                            0 => 'search_for',
                        ),
                    2 => '?search_for={k}',
                ),
            'search.imesh.com' =>
                array (
                    0 => 'iMesh',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'si',
                        ),
                    2 => 'web?q={k}',
                ),
            'www2.inbox.com' =>
                array (
                    0 => 'Inbox',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/results1.aspx?q={k}',
                ),
            'infospace.com' =>
                array (
                    0 => 'InfoSpace',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '/search/web?q={k}',
                ),
            'dogpile.com' =>
                array (
                    0 => 'InfoSpace',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '/search/web?q={k}',
                ),
            'tattoodle.com' =>
                array (
                    0 => 'InfoSpace',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '/search/web?q={k}',
                ),
            'metacrawler.com' =>
                array (
                    0 => 'InfoSpace',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '/search/web?q={k}',
                ),
            'webfetch.com' =>
                array (
                    0 => 'InfoSpace',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '/search/web?q={k}',
                ),
            'webcrawler.com' =>
                array (
                    0 => 'InfoSpace',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '/search/web?q={k}',
                ),
            'search.kiwee.com' =>
                array (
                    0 => 'InfoSpace',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '/search/web?q={k}',
                ),
            'searches.vi-view.com' =>
                array (
                    0 => 'InfoSpace',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '/search/web?q={k}',
                ),
            'search.webssearches.com' =>
                array (
                    0 => 'InfoSpace',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '/search/web?q={k}',
                ),
            'search.fbdownloader.com' =>
                array (
                    0 => 'InfoSpace',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '/search/web?q={k}',
                ),
            'searches3.globososo.com' =>
                array (
                    0 => 'InfoSpace',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '/search/web?q={k}',
                ),
            'www.google.interia.pl' =>
                array (
                    0 => 'Interia',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'szukaj?q={k}',
                ),
            'ixquick.com' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'www.eu.ixquick.com' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'ixquick.de' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'www.ixquick.de' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'us.ixquick.com' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            's1.us.ixquick.com' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            's2.us.ixquick.com' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            's3.us.ixquick.com' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            's4.us.ixquick.com' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            's5.us.ixquick.com' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'eu.ixquick.com' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            's8-eu.ixquick.com' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            's1-eu.ixquick.de' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            's2-eu4.ixquick.com' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            's5-eu4.ixquick.com' =>
                array (
                    0 => 'Ixquick',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'junglekey.com' =>
                array (
                    0 => 'Jungle Key',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search.php?query={k}&type=web&lang=en',
                ),
            'junglekey.fr' =>
                array (
                    0 => 'Jungle Key',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search.php?query={k}&type=web&lang=en',
                ),
            'www.jungle-spider.de' =>
                array (
                    0 => 'Jungle Spider',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'jyxo.1188.cz' =>
                array (
                    0 => 'Jyxo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 's?q={k}',
                ),
            'k9safesearch.com' =>
                array (
                    0 => 'K9 Safe Search',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search.jsp?q={k}',
                ),
            'www.kataweb.it' =>
                array (
                    0 => 'Kataweb',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'www.kensaq.com' =>
                array (
                    0 => 'Kensaq',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web?q={k}',
                ),
            'www.kvasir.no' =>
                array (
                    0 => 'Kvasir',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'alle?q={k}',
                ),
            'www.toile.com' =>
                array (
                    0 => 'La Toile Du Québec (Google)',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'web.toile.com' =>
                array (
                    0 => 'La Toile Du Québec (Google)',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'www.latne.lv' =>
                array (
                    0 => 'Latne',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'siets.php?q={k}',
                ),
            'lo.st' =>
                array (
                    0 => 'Lo.st',
                    1 =>
                        array (
                            0 => 'x_query',
                        ),
                    2 => 'cgi-bin/eolost.cgi?x_query={k}',
                ),
            'www.lookany.com' =>
                array (
                    0 => 'LookAny',
                    1 =>
                        array (
                            0 => '/(?:search|images|videos)\\/([^\\/]+)/',
                        ),
                ),
            'www.looksmart.com' =>
                array (
                    0 => 'Looksmart',
                    1 =>
                        array (
                            0 => 'key',
                        ),
                ),
            'search.lycos.com' =>
                array (
                    0 => 'Lycos',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => '?query={k}',
                ),
            'lycos.{}' =>
                array (
                    0 => 'Lycos',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => '?query={k}',
                ),
            'www.maailm.com' =>
                array (
                    0 => 'maailm.com',
                    1 =>
                        array (
                            0 => 'tekst',
                        ),
                ),
            'go.mail.ru' =>
                array (
                    0 => 'Mailru',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?rch=e&q={k}',
                    3 =>
                        array (
                            0 => 'UTF-8',
                            1 => 'windows-1251',
                        ),
                ),
            'www.mamma.com' =>
                array (
                    0 => 'Mamma',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'result.php?q={k}',
                ),
            'mamma75.mamma.com' =>
                array (
                    0 => 'Mamma',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'result.php?q={k}',
                ),
            'www.meinestadt.de' =>
                array (
                    0 => 'Meinestadt.de',
                    1 =>
                        array (
                            0 => 'words',
                        ),
                ),
            'meta.ua' =>
                array (
                    0 => 'Meta.ua',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search.asp?q={k}',
                ),
            's1.metacrawler.de' =>
                array (
                    0 => 'MetaCrawler DE',
                    1 =>
                        array (
                            0 => 'qry',
                        ),
                    2 => '?qry={k}',
                ),
            's2.metacrawler.de' =>
                array (
                    0 => 'MetaCrawler DE',
                    1 =>
                        array (
                            0 => 'qry',
                        ),
                    2 => '?qry={k}',
                ),
            's3.metacrawler.de' =>
                array (
                    0 => 'MetaCrawler DE',
                    1 =>
                        array (
                            0 => 'qry',
                        ),
                    2 => '?qry={k}',
                ),
            'meta.rrzn.uni-hannover.de' =>
                array (
                    0 => 'Metager',
                    1 =>
                        array (
                            0 => 'eingabe',
                        ),
                    2 => 'meta/cgi-bin/meta.ger1?eingabe={k}',
                ),
            'www.metager.de' =>
                array (
                    0 => 'Metager',
                    1 =>
                        array (
                            0 => 'eingabe',
                        ),
                    2 => 'meta/cgi-bin/meta.ger1?eingabe={k}',
                ),
            'metager.de' =>
                array (
                    0 => 'Metager',
                    1 =>
                        array (
                            0 => 'eingabe',
                        ),
                    2 => 'meta/cgi-bin/meta.ger1?eingabe={k}',
                ),
            'metager2.de' =>
                array (
                    0 => 'Metager2',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/index.php?q={k}',
                ),
            'www.mister-wong.com' =>
                array (
                    0 => 'Mister Wong',
                    1 =>
                        array (
                            0 => 'keywords',
                        ),
                    2 => 'search/?keywords={k}',
                ),
            'www.mister-wong.de' =>
                array (
                    0 => 'Mister Wong',
                    1 =>
                        array (
                            0 => 'keywords',
                        ),
                    2 => 'search/?keywords={k}',
                ),
            'www.monstercrawler.com' =>
                array (
                    0 => 'Monstercrawler',
                    1 =>
                        array (
                            0 => 'qry',
                        ),
                ),
            'www.mozbot.fr' =>
                array (
                    0 => 'mozbot',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'results.php?q={k}',
                ),
            'www.mozbot.co.uk' =>
                array (
                    0 => 'mozbot',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'results.php?q={k}',
                ),
            'www.mozbot.com' =>
                array (
                    0 => 'mozbot',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'results.php?q={k}',
                ),
            'searchservice.myspace.com' =>
                array (
                    0 => 'MySpace',
                    1 =>
                        array (
                            0 => 'qry',
                        ),
                    2 => 'index.cfm?fuseaction=sitesearch.results&type=Web&qry={k}',
                ),
            'www.mysearch.com' =>
                array (
                    0 => 'MyWebSearch',
                    1 =>
                        array (
                            0 => 'searchfor',
                            1 => 'searchFor',
                        ),
                    2 => 'search/Ajmain.jhtml?searchfor={k}',
                ),
            'ms114.mysearch.com' =>
                array (
                    0 => 'MyWebSearch',
                    1 =>
                        array (
                            0 => 'searchfor',
                            1 => 'searchFor',
                        ),
                    2 => 'search/Ajmain.jhtml?searchfor={k}',
                ),
            'ms146.mysearch.com' =>
                array (
                    0 => 'MyWebSearch',
                    1 =>
                        array (
                            0 => 'searchfor',
                            1 => 'searchFor',
                        ),
                    2 => 'search/Ajmain.jhtml?searchfor={k}',
                ),
            'kf.mysearch.myway.com' =>
                array (
                    0 => 'MyWebSearch',
                    1 =>
                        array (
                            0 => 'searchfor',
                            1 => 'searchFor',
                        ),
                    2 => 'search/Ajmain.jhtml?searchfor={k}',
                ),
            'ki.mysearch.myway.com' =>
                array (
                    0 => 'MyWebSearch',
                    1 =>
                        array (
                            0 => 'searchfor',
                            1 => 'searchFor',
                        ),
                    2 => 'search/Ajmain.jhtml?searchfor={k}',
                ),
            'search.myway.com' =>
                array (
                    0 => 'MyWebSearch',
                    1 =>
                        array (
                            0 => 'searchfor',
                            1 => 'searchFor',
                        ),
                    2 => 'search/Ajmain.jhtml?searchfor={k}',
                ),
            'search.mywebsearch.com' =>
                array (
                    0 => 'MyWebSearch',
                    1 =>
                        array (
                            0 => 'searchfor',
                            1 => 'searchFor',
                        ),
                    2 => 'search/Ajmain.jhtml?searchfor={k}',
                ),
            'www.najdi.si' =>
                array (
                    0 => 'Najdi.si',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search.jsp?q={k}',
                ),
            'search.nate.com' =>
                array (
                    0 => 'Nate',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/all.html?q={k}',
                    3 =>
                        array (
                            0 => 'EUC-KR',
                        ),
                ),
            'search.naver.com' =>
                array (
                    0 => 'Naver',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search.naver?query={k}',
                ),
            'ko.search.need2find.com' =>
                array (
                    0 => 'Needtofind',
                    1 =>
                        array (
                            0 => 'searchfor',
                        ),
                    2 => 'search/AJmain.jhtml?searchfor={k}',
                ),
            'www.neti.ee' =>
                array (
                    0 => 'Neti',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'cgi-bin/otsing?query={k}',
                    3 =>
                        array (
                            0 => 'iso-8859-1',
                        ),
                ),
            'search.nifty.com' =>
                array (
                    0 => 'Nifty',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'Text',
                        ),
                    2 => 'websearch/search?q={k}',
                ),
            'search.azby.fmworld.net' =>
                array (
                    0 => 'Nifty',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'Text',
                        ),
                    2 => 'websearch/search?q={k}',
                ),
            'videosearch.nifty.com' =>
                array (
                    0 => 'Nifty Videos',
                    1 =>
                        array (
                            0 => 'kw',
                        ),
                    2 => 'search?kw={k}',
                ),
            'nigma.ru' =>
                array (
                    0 => 'Nigma',
                    1 =>
                        array (
                            0 => 's',
                        ),
                    2 => 'index.php?s={k}',
                ),
            'szukaj.onet.pl' =>
                array (
                    0 => 'Onet.pl',
                    1 =>
                        array (
                            0 => 'qt',
                        ),
                    2 => 'query.html?qt={k}',
                ),
            'online.no' =>
                array (
                    0 => 'Online.no',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'google/index.jsp?q={k}',
                ),
            'www.1881.no' =>
                array (
                    0 => 'Opplysningen 1881',
                    1 =>
                        array (
                            0 => 'Query',
                        ),
                    2 => 'Multi/?Query={k}',
                ),
            'busca.orange.es' =>
                array (
                    0 => 'Orange',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'www.paperball.de' =>
                array (
                    0 => 'Paperball',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'suche/s/?q={k}',
                ),
            'extern.peoplecheck.de' =>
                array (
                    0 => 'PeopleCheck',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'link.php?q={k}',
                ),
            'search.peoplepc.com' =>
                array (
                    0 => 'PeoplePC',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'www.picsearch.com' =>
                array (
                    0 => 'Picsearch',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'index.cgi?q={k}',
                ),
            'www.plazoo.com' =>
                array (
                    0 => 'Plazoo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'plusnetwork.com' =>
                array (
                    0 => 'PlusNetwork',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'poisk.ru' =>
                array (
                    0 => 'Poisk.Ru',
                    1 =>
                        array (
                            0 => 'text',
                        ),
                    2 => 'cgi-bin/poisk?text={k}',
                    3 =>
                        array (
                            0 => 'windows-1251',
                        ),
                ),
            'search.qip.ru' =>
                array (
                    0 => 'qip.ru',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search?query={k}',
                ),
            'www.qualigo.at' =>
                array (
                    0 => 'Qualigo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'www.qualigo.ch' =>
                array (
                    0 => 'Qualigo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'www.qualigo.de' =>
                array (
                    0 => 'Qualigo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'www.qualigo.nl' =>
                array (
                    0 => 'Qualigo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'www.qwant.com' =>
                array (
                    0 => 'Qwant',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'websearch.rakuten.co.jp' =>
                array (
                    0 => 'Rakuten',
                    1 =>
                        array (
                            0 => 'qt',
                        ),
                    2 => 'WebIS?qt={k}',
                ),
            'nova.rambler.ru' =>
                array (
                    0 => 'Rambler',
                    1 =>
                        array (
                            0 => 'query',
                            1 => 'words',
                        ),
                    2 => 'search?query={k}',
                ),
            'search.rr.com' =>
                array (
                    0 => 'Road Runner',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'rpmfind.net' =>
                array (
                    0 => 'rpmfind',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'linux/rpm2html/search.php?query={k}',
                ),
            'fr2.rpmfind.net' =>
                array (
                    0 => 'rpmfind',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'linux/rpm2html/search.php?query={k}',
                ),
            'pesquisa.sapo.pt' =>
                array (
                    0 => 'Sapo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'scour.com' =>
                array (
                    0 => 'Scour.com',
                    1 =>
                        array (
                            0 => '/search\\/[^\\/]+\\/(.*)/',
                        ),
                    2 => 'search/web/{k}',
                ),
            'www.search.ch' =>
                array (
                    0 => 'Search.ch',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'www.search.com' =>
                array (
                    0 => 'Search.com',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'searchalot.com' =>
                array (
                    0 => 'Searchalot',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'www.searchcanvas.com' =>
                array (
                    0 => 'SearchCanvas',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web?q={k}',
                ),
            'www.searchy.co.uk' =>
                array (
                    0 => 'Searchy',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'index.html?q={k}',
                ),
            'search.seesaa.jp' =>
                array (
                    0 => 'SeeSaa',
                    1 =>
                        array (
                            0 => '/\\/([^\\/]+)\\/index\\.html/',
                        ),
                    2 => '{k}/index.html',
                ),
            'bg.setooz.com' =>
                array (
                    0 => 'Setooz',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search?query={k}',
                ),
            'da.setooz.com' =>
                array (
                    0 => 'Setooz',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search?query={k}',
                ),
            'el.setooz.com' =>
                array (
                    0 => 'Setooz',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search?query={k}',
                ),
            'fa.setooz.com' =>
                array (
                    0 => 'Setooz',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search?query={k}',
                ),
            'ur.setooz.com' =>
                array (
                    0 => 'Setooz',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search?query={k}',
                ),
            '{}.setooz.com' =>
                array (
                    0 => 'Setooz',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search?query={k}',
                ),
            'search.seznam.cz' =>
                array (
                    0 => 'Seznam',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'videa.seznam.cz' =>
                array (
                    0 => 'Seznam Videa',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'www.sharelook.fr' =>
                array (
                    0 => 'Sharelook',
                    1 =>
                        array (
                            0 => 'keyword',
                        ),
                ),
            'www.skynet.be' =>
                array (
                    0 => 'Skynet',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'services/recherche/google?q={k}',
                ),
            'm.sm.cn' =>
                array (
                    0 => 'sm.cn',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 's?q={k}',
                ),
            'm.sp.sm.cn' =>
                array (
                    0 => 'sm.cn',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 's?q={k}',
                ),
            'www.sm.de' =>
                array (
                    0 => 'sm.de',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'search.smartaddressbar.com' =>
                array (
                    0 => 'SmartAddressbar',
                    1 =>
                        array (
                            0 => 's',
                        ),
                    2 => '?s={k}',
                ),
            'search.snap.do' =>
                array (
                    0 => 'Snap.do',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'www.so-net.ne.jp' =>
                array (
                    0 => 'So-net',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search/web/?query={k}',
                ),
            'video.so-net.ne.jp' =>
                array (
                    0 => 'So-net Videos',
                    1 =>
                        array (
                            0 => 'kw',
                        ),
                    2 => 'search/?kw={k}',
                ),
            'search.softonic.com' =>
                array (
                    0 => 'Softonic',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'default/default?q={k}',
                ),
            'www.sogou.com' =>
                array (
                    0 => 'Sogou',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'web?query={k}',
                    3 =>
                        array (
                            0 => 'gb2312',
                        ),
                ),
            'www.soso.com' =>
                array (
                    0 => 'Soso',
                    1 =>
                        array (
                            0 => 'w',
                        ),
                    2 => 'q?w={k}',
                    3 =>
                        array (
                            0 => 'gb2312',
                        ),
                ),
            'www.sputnik.ru' =>
                array (
                    0 => 'Sputnik',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'startgoogle.startpagina.nl' =>
                array (
                    0 => 'Startpagina (Google)',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'www.startsiden.no' =>
                array (
                    0 => 'Startsiden',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'sok/index.html?q={k}',
                ),
            'suche.info' =>
                array (
                    0 => 'Suche.info',
                    1 =>
                        array (
                            0 => 'Keywords',
                        ),
                    2 => 'suche.php?Keywords={k}',
                ),
            'www.suchmaschine.com' =>
                array (
                    0 => 'Suchmaschine.com',
                    1 =>
                        array (
                            0 => 'suchstr',
                        ),
                    2 => 'cgi-bin/wo.cgi?suchstr={k}',
                ),
            'www.suchnase.de' =>
                array (
                    0 => 'Suchnase',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'surfcanyon.com' =>
                array (
                    0 => 'Surf Canyon',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'suche.t-online.de' =>
                array (
                    0 => 'T-Online',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'fast-cgi/tsc?mandant=toi&context=internet-tab&q={k}',
                ),
            'brisbane.t-online.de' =>
                array (
                    0 => 'T-Online',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'fast-cgi/tsc?mandant=toi&context=internet-tab&q={k}',
                ),
            'www.talimba.com' =>
                array (
                    0 => 'talimba',
                    1 =>
                        array (
                            0 => 'search',
                        ),
                    2 => 'index.php?page=search/web&search={k}',
                ),
            'www.talktalk.co.uk' =>
                array (
                    0 => 'TalkTalk',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search/results.html?query={k}',
                ),
            'technorati.com' =>
                array (
                    0 => 'Technorati',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?return=sites&authority=all&q={k}',
                ),
            'www.teoma.com' =>
                array (
                    0 => 'Teoma',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'web?q={k}',
                ),
            'buscador.terra.es' =>
                array (
                    0 => 'Terra',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'Default.aspx?source=Search&query={k}',
                ),
            'buscador.terra.cl' =>
                array (
                    0 => 'Terra',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'Default.aspx?source=Search&query={k}',
                ),
            'buscador.terra.com.br' =>
                array (
                    0 => 'Terra',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'Default.aspx?source=Search&query={k}',
                ),
            'search.tiscali.it' =>
                array (
                    0 => 'Tiscali',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'key',
                        ),
                    2 => '?q={k}',
                ),
            'search-dyn.tiscali.it' =>
                array (
                    0 => 'Tiscali',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'key',
                        ),
                    2 => '?q={k}',
                ),
            'www.tixuma.de' =>
                array (
                    0 => 'Tixuma',
                    1 =>
                        array (
                            0 => 'sc',
                        ),
                    2 => 'index.php?mp=search&stp=&sc={k}&tg=0',
                ),
            'www.toolbarhome.com' =>
                array (
                    0 => 'Toolbarhome',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search.aspx?q={k}',
                ),
            'vshare.toolbarhome.com' =>
                array (
                    0 => 'Toolbarhome',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search.aspx?q={k}',
                ),
            'www.toppreise.ch' =>
                array (
                    0 => 'Toppreise.ch',
                    1 =>
                        array (
                            0 => 'search',
                        ),
                    2 => 'index.php?search={k}',
                    3 =>
                        array (
                            0 => 'ISO-8859-1',
                        ),
                ),
            'toppreise.ch' =>
                array (
                    0 => 'Toppreise.ch',
                    1 =>
                        array (
                            0 => 'search',
                        ),
                    2 => 'index.php?search={k}',
                    3 =>
                        array (
                            0 => 'ISO-8859-1',
                        ),
                ),
            'fr.toppreise.ch' =>
                array (
                    0 => 'Toppreise.ch',
                    1 =>
                        array (
                            0 => 'search',
                        ),
                    2 => 'index.php?search={k}',
                    3 =>
                        array (
                            0 => 'ISO-8859-1',
                        ),
                ),
            'de.toppreise.ch' =>
                array (
                    0 => 'Toppreise.ch',
                    1 =>
                        array (
                            0 => 'search',
                        ),
                    2 => 'index.php?search={k}',
                    3 =>
                        array (
                            0 => 'ISO-8859-1',
                        ),
                ),
            'en.toppreise.ch' =>
                array (
                    0 => 'Toppreise.ch',
                    1 =>
                        array (
                            0 => 'search',
                        ),
                    2 => 'index.php?search={k}',
                    3 =>
                        array (
                            0 => 'ISO-8859-1',
                        ),
                ),
            'www.trouvez.com' =>
                array (
                    0 => 'Trouvez.com',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'www.trovarapido.com' =>
                array (
                    0 => 'TrovaRapido',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'result.php?q={k}',
                ),
            'www.trusted-search.com' =>
                array (
                    0 => 'Trusted Search',
                    1 =>
                        array (
                            0 => 'w',
                        ),
                    2 => 'search?w={k}',
                ),
            'www.twingly.com' =>
                array (
                    0 => 'Twingly',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search?q={k}',
                ),
            'busca.uol.com.br' =>
                array (
                    0 => 'uol.com.br',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '/web/?q={k}',
                ),
            'www.url.org' =>
                array (
                    0 => 'URL.ORGanzier',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?l=de&q={k}',
                ),
            'www.vinden.nl' =>
                array (
                    0 => 'Vinden',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'www.vindex.nl' =>
                array (
                    0 => 'Vindex',
                    1 =>
                        array (
                            0 => 'search_for',
                        ),
                    2 => '/web?search_for={k}',
                ),
            'search.vindex.nl' =>
                array (
                    0 => 'Vindex',
                    1 =>
                        array (
                            0 => 'search_for',
                        ),
                    2 => '/web?search_for={k}',
                ),
            'ricerca.virgilio.it' =>
                array (
                    0 => 'Virgilio',
                    1 =>
                        array (
                            0 => 'qs',
                        ),
                    2 => 'ricerca?qs={k}',
                ),
            'ricercaimmagini.virgilio.it' =>
                array (
                    0 => 'Virgilio',
                    1 =>
                        array (
                            0 => 'qs',
                        ),
                    2 => 'ricerca?qs={k}',
                ),
            'ricercavideo.virgilio.it' =>
                array (
                    0 => 'Virgilio',
                    1 =>
                        array (
                            0 => 'qs',
                        ),
                    2 => 'ricerca?qs={k}',
                ),
            'ricercanews.virgilio.it' =>
                array (
                    0 => 'Virgilio',
                    1 =>
                        array (
                            0 => 'qs',
                        ),
                    2 => 'ricerca?qs={k}',
                ),
            'search.ke.voila.fr' =>
                array (
                    0 => 'Voila',
                    1 =>
                        array (
                            0 => 'rdata',
                        ),
                    2 => 'S/voila?rdata={k}',
                ),
            'www.lemoteur.fr' =>
                array (
                    0 => 'Voila',
                    1 =>
                        array (
                            0 => 'rdata',
                        ),
                    2 => 'S/voila?rdata={k}',
                ),
            'web.volny.cz' =>
                array (
                    0 => 'Volny',
                    1 =>
                        array (
                            0 => 'search',
                        ),
                    2 => 'fulltext/?search={k}',
                    3 =>
                        array (
                            0 => 'windows-1250',
                        ),
                ),
            'www.walhello.info' =>
                array (
                    0 => 'Walhello',
                    1 =>
                        array (
                            0 => 'key',
                        ),
                    2 => 'search?key={k}',
                ),
            'www.walhello.com' =>
                array (
                    0 => 'Walhello',
                    1 =>
                        array (
                            0 => 'key',
                        ),
                    2 => 'search?key={k}',
                ),
            'www.walhello.de' =>
                array (
                    0 => 'Walhello',
                    1 =>
                        array (
                            0 => 'key',
                        ),
                    2 => 'search?key={k}',
                ),
            'www.walhello.nl' =>
                array (
                    0 => 'Walhello',
                    1 =>
                        array (
                            0 => 'key',
                        ),
                    2 => 'search?key={k}',
                ),
            'suche.web.de' =>
                array (
                    0 => 'Web.de',
                    1 =>
                        array (
                            0 => 'su',
                            1 => 'q',
                        ),
                    2 => 'search/web/?su={k}',
                ),
            'm.suche.web.de' =>
                array (
                    0 => 'Web.de',
                    1 =>
                        array (
                            0 => 'su',
                            1 => 'q',
                        ),
                    2 => 'search/web/?su={k}',
                ),
            'www.web.nl' =>
                array (
                    0 => 'Web.nl',
                    1 =>
                        array (
                            0 => 'zoekwoord',
                        ),
                ),
            'www.weborama.fr' =>
                array (
                    0 => 'weborama',
                    1 =>
                        array (
                            0 => 'QUERY',
                        ),
                ),
            'www.websearch.com' =>
                array (
                    0 => 'WebSearch',
                    1 =>
                        array (
                            0 => 'qkw',
                            1 => 'q',
                        ),
                    2 => 'search/results2.aspx?q={k}',
                ),
            'fr.wedoo.com' =>
                array (
                    0 => 'Wedoo',
                    1 =>
                        array (
                            0 => 'keyword',
                        ),
                ),
            'en.wedoo.com' =>
                array (
                    0 => 'Wedoo',
                    1 =>
                        array (
                            0 => 'keyword',
                        ),
                ),
            'es.wedoo.com' =>
                array (
                    0 => 'Wedoo',
                    1 =>
                        array (
                            0 => 'keyword',
                        ),
                ),
            'search.winamp.com' =>
                array (
                    0 => 'Winamp',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/search?q={k}',
                ),
            'szukaj.wp.pl' =>
                array (
                    0 => 'Wirtualna Polska',
                    1 =>
                        array (
                            0 => 'szukaj',
                        ),
                    2 => 'http://szukaj.wp.pl/szukaj.html?szukaj={k}',
                ),
            'www.witch.de' =>
                array (
                    0 => 'Witch',
                    1 =>
                        array (
                            0 => 'search',
                        ),
                    2 => 'search-result.php?cn=0&search={k}',
                ),
            'www.woopie.jp' =>
                array (
                    0 => 'Woopie',
                    1 =>
                        array (
                            0 => 'kw',
                        ),
                    2 => 'search?kw={k}',
                ),
            'search.www.ee' =>
                array (
                    0 => 'www värav',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'www.x-recherche.com' =>
                array (
                    0 => 'X-Recherche',
                    1 =>
                        array (
                            0 => 'MOTS',
                        ),
                    2 => 'cgi-bin/websearch?MOTS={k}',
                ),
            'search.yahoo.com' =>
                array (
                    0 => 'Yahoo!',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'q',
                        ),
                    2 => 'search?p={k}',
                ),
            'malaysia.search.yahoo.com' =>
                array (
                    0 => 'Yahoo!',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'q',
                        ),
                    2 => 'search?p={k}',
                ),
            'yahoo.com' =>
                array (
                    0 => 'Yahoo!',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'q',
                        ),
                    2 => 'search?p={k}',
                ),
            'yahoo.{}' =>
                array (
                    0 => 'Yahoo!',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'q',
                        ),
                    2 => 'search?p={k}',
                ),
            '{}.yahoo.com' =>
                array (
                    0 => 'Yahoo!',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'q',
                        ),
                    2 => 'search?p={k}',
                ),
            'cade.yahoo.com' =>
                array (
                    0 => 'Yahoo!',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'q',
                        ),
                    2 => 'search?p={k}',
                ),
            'espanol.yahoo.com' =>
                array (
                    0 => 'Yahoo!',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'q',
                        ),
                    2 => 'search?p={k}',
                ),
            'qc.yahoo.com' =>
                array (
                    0 => 'Yahoo!',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'q',
                        ),
                    2 => 'search?p={k}',
                ),
            'one.cn.yahoo.com' =>
                array (
                    0 => 'Yahoo!',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'q',
                        ),
                    2 => 'search?p={k}',
                ),
            'search.yahoo.com/search/dir' =>
                array (
                    0 => 'Yahoo! Directory',
                    1 =>
                        array (
                            0 => 'p',
                        ),
                    2 => '?p={k}',
                ),
            'images.search.yahoo.com' =>
                array (
                    0 => 'Yahoo! Images',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'va',
                        ),
                    2 => 'search/images?p={k}',
                ),
            '{}.images.yahoo.com' =>
                array (
                    0 => 'Yahoo! Images',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'va',
                        ),
                    2 => 'search/images?p={k}',
                ),
            'cade.images.yahoo.com' =>
                array (
                    0 => 'Yahoo! Images',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'va',
                        ),
                    2 => 'search/images?p={k}',
                ),
            'espanol.images.yahoo.com' =>
                array (
                    0 => 'Yahoo! Images',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'va',
                        ),
                    2 => 'search/images?p={k}',
                ),
            'qc.images.yahoo.com' =>
                array (
                    0 => 'Yahoo! Images',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'va',
                        ),
                    2 => 'search/images?p={k}',
                ),
            'search.yahoo.co.jp' =>
                array (
                    0 => 'Yahoo! Japan',
                    1 =>
                        array (
                            0 => 'p',
                            1 => 'vp',
                        ),
                    2 => 'search?p={k}',
                ),
            'image.search.yahoo.co.jp' =>
                array (
                    0 => 'Yahoo! Japan Images',
                    1 =>
                        array (
                            0 => 'p',
                        ),
                    2 => 'search?p={k}',
                ),
            'video.search.yahoo.co.jp' =>
                array (
                    0 => 'Yahoo! Japan Videos',
                    1 =>
                        array (
                            0 => 'p',
                        ),
                    2 => 'search?p={k}',
                ),
            'search.yam.com' =>
                array (
                    0 => 'Yam',
                    1 =>
                        array (
                            0 => 'k',
                        ),
                    2 => 'Search/Web/?SearchType=web&k={k}',
                ),
            'yandex.ru' =>
                array (
                    0 => 'Yandex',
                    1 =>
                        array (
                            0 => 'text',
                        ),
                    2 => 'yandsearch?text={k}',
                ),
            'yandex.com' =>
                array (
                    0 => 'Yandex',
                    1 =>
                        array (
                            0 => 'text',
                        ),
                    2 => 'yandsearch?text={k}',
                ),
            'yandex.{}' =>
                array (
                    0 => 'Yandex',
                    1 =>
                        array (
                            0 => 'text',
                        ),
                    2 => 'yandsearch?text={k}',
                ),
            'images.yandex.ru' =>
                array (
                    0 => 'Yandex Images',
                    1 =>
                        array (
                            0 => 'text',
                        ),
                    2 => 'yandsearch?text={k}',
                ),
            'images.yandex.com' =>
                array (
                    0 => 'Yandex Images',
                    1 =>
                        array (
                            0 => 'text',
                        ),
                    2 => 'yandsearch?text={k}',
                ),
            'images.yandex.{}' =>
                array (
                    0 => 'Yandex Images',
                    1 =>
                        array (
                            0 => 'text',
                        ),
                    2 => 'yandsearch?text={k}',
                ),
            'www.yasni.de' =>
                array (
                    0 => 'Yasni',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'www.yasni.com' =>
                array (
                    0 => 'Yasni',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'www.yasni.co.uk' =>
                array (
                    0 => 'Yasni',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'www.yasni.ch' =>
                array (
                    0 => 'Yasni',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'www.yasni.at' =>
                array (
                    0 => 'Yasni',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                ),
            'www.yatedo.com' =>
                array (
                    0 => 'Yatedo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/profil?q={k}',
                ),
            'www.yatedo.fr' =>
                array (
                    0 => 'Yatedo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => 'search/profil?q={k}',
                ),
            'yellowmap.de' =>
                array (
                    0 => 'Yellowmap',
                    1 => NULL,
                ),
            'search.yippy.com' =>
                array (
                    0 => 'Yippy',
                    1 =>
                        array (
                            0 => 'query',
                        ),
                    2 => 'search?query={k}',
                ),
            'www.yougoo.fr' =>
                array (
                    0 => 'YouGoo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?cx=search&q={k}',
                ),
            'www.zapmeta.com' =>
                array (
                    0 => 'Zapmeta',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'query',
                        ),
                    2 => '?q={k}',
                ),
            'zapmeta.{}' =>
                array (
                    0 => 'Zapmeta',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'query',
                        ),
                    2 => '?q={k}',
                ),
            'uk.zapmeta.com' =>
                array (
                    0 => 'Zapmeta',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'query',
                        ),
                    2 => '?q={k}',
                ),
            'ar.zapmeta.com' =>
                array (
                    0 => 'Zapmeta',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'query',
                        ),
                    2 => '?q={k}',
                ),
            'au.zapmeta.com' =>
                array (
                    0 => 'Zapmeta',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'query',
                        ),
                    2 => '?q={k}',
                ),
            'ca.zapmeta.com' =>
                array (
                    0 => 'Zapmeta',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'query',
                        ),
                    2 => '?q={k}',
                ),
            'fi.zapmeta.com' =>
                array (
                    0 => 'Zapmeta',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'query',
                        ),
                    2 => '?q={k}',
                ),
            'no.zapmeta.com' =>
                array (
                    0 => 'Zapmeta',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'query',
                        ),
                    2 => '?q={k}',
                ),
            'tr.zapmeta.com' =>
                array (
                    0 => 'Zapmeta',
                    1 =>
                        array (
                            0 => 'q',
                            1 => 'query',
                        ),
                    2 => '?q={k}',
                ),
            'p.zhongsou.com' =>
                array (
                    0 => 'Zhongsou',
                    1 =>
                        array (
                            0 => 'w',
                        ),
                    2 => 'p?w={k}',
                ),
            'www3.zoek.nl' =>
                array (
                    0 => 'Zoek',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                ),
            'www.zoeken.nl' =>
                array (
                    0 => 'Zoeken',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                ),
            'zoohoo.cz' =>
                array (
                    0 => 'Zoohoo',
                    1 =>
                        array (
                            0 => 'q',
                        ),
                    2 => '?q={k}',
                    3 =>
                        array (
                            0 => 'windows-1250',
                        ),
                ),
            'www.zoznam.sk' =>
                array (
                    0 => 'Zoznam',
                    1 =>
                        array (
                            0 => 's',
                        ),
                    2 => 'hladaj.fcgi?s={k}&co=svet',
                ),
            'www.zxuso.com' =>
                array (
                    0 => 'Zxuso',
                    1 =>
                        array (
                            0 => 'wd',
                        ),
                    2 => 'ri/?wd={k}',
                ),
            'kwzf.net' =>
                array (
                    0 => '묻지마 검색',
                    1 =>
                        array (
                            0 => 'search',
                        ),
                    2 => '#search={k}',
                ),
        );

    $GLOBALS['PowerStats_SearchEngines_NameToUrl'] = array();
    foreach ($GLOBALS['PowerStats_SearchEngines'] as $url => $info) {
        if (!isset($GLOBALS['PowerStats_SearchEngines_NameToUrl'][$info[0]])) {
            $GLOBALS['PowerStats_SearchEngines_NameToUrl'][$info[0]] = $url;
        }
    }
}
