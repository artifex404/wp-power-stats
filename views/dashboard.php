<?php

function trim_text($input, $length, $ellipses = true) {
  
    // no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }
  
    // find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    if (!$last_space) $last_space = $length;
    $trimmed_text = substr($input, 0, $last_space);
  
    // add ellipses
    if ($ellipses) {
        $trimmed_text .= '...';
    }
  
    return $trimmed_text;
}

?>

<div class="wrap">

    <h2><?php _e('Overview','wp-power-stats') ?></h2>
    
    <div class="container">
        <div class="metabox-holder">
        
        
            <div class="one-third column">
                <div class="cell">
                    <div class="postbox-container">
                        <div class="postbox micro">
                            <h3><?php _e('Summary','wp-power-stats') ?></h3>
    
                            <div class="inside">
                            
                                <table class="summary">
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <td class="value"><?php _e('Visitors','wp-power-stats') ?></td>
                                            <td class="value"><?php _e('Pageviews','wp-power-stats') ?></td>
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        <tr>
                                            <td><?php _e('Today','wp-power-stats') ?></td>
                                            <td class="value"><?php echo $today_visits[0] ?></td>
                                            <td class="value"><?php echo $today_pageviews[0] ?></td>
                                        </tr>
    
                                        <tr>
                                            <td><?php _e('This Week','wp-power-stats') ?></td>
                                            <td class="value"><?php echo $this_week_visits[0] ?></td>
                                            <td class="value"><?php echo $this_week_pageviews[0] ?></td>
                                        </tr>
    
                                        <tr>
                                            <td><?php _e('This Month','wp-power-stats') ?></td>
                                            <td class="value"><?php echo $this_month_visits[0] ?></td>
                                            <td class="value"><?php echo $this_month_pageviews[0] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div><!-- inside -->
                        </div><!-- postbox -->
    
                        <div class="postbox micro">
                            <h3><?php _e('Devices','wp-power-stats') ?></h3>
    
                            <div class="inside">
                            
                                <table class="triple">
                                    <tbody>
                                        <tr>
                                            <td><img src="<?php echo plugins_url('wp-power-stats/images/desktop.png') ?>" alt="<?php _e('Desktop','wp-power-stats') ?>"></td>
                                            <td><img src="<?php echo plugins_url('wp-power-stats/images/tablet.png') ?>" alt="<?php _e('Tablet','wp-power-stats') ?>"></td>
                                            <td><img src="<?php echo plugins_url('wp-power-stats/images/mobile.png') ?>" alt="<?php _e('Mobile','wp-power-stats') ?>"></td>
                                        </tr>
                                        <tr>
                                            <td class="percent"><?php echo $desktop ?><span>%</span></td>
                                            <td class="percent"><?php echo $tablet ?><span>%</span></td>
                                            <td class="percent"><?php echo $mobile ?><span>%</span></td>
                                        </tr>
                                        <tr>
                                            <td><?php _e('Desktop','wp-power-stats') ?></td>
                                            <td><?php _e('Tablet','wp-power-stats') ?></td>
                                            <td><?php _e('Mobile','wp-power-stats') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div><!-- inside -->
                        </div><!-- postbox -->
                    </div><!-- postbox-container -->
                </div><!-- cell -->
            </div><!-- one-third -->
    
            <div class="two-thirds column">
                <div class="cell">
    
    
        			<div class="postbox-container">
    					<div class="postbox double-height">
    						<h3><span><?php _e('Visitors & Page Views','wp-power-stats') ?></span></h3>
    					
    						<div class="inside">
    
    							<?php 
    							
    						    $data_array = "";
    							$visits = array_reverse($visits);
    							
                                if (is_array($visits) && !empty($visits)) : ?>
    
                                    <?php foreach ($visits as $day) {
        									if ($day['hits'] === null) $day['hits'] = 0;
        									if ($day['pageviews'] === null) $day['pageviews'] = 0;
        									$data_array .= "['".$day['date']."', ".$day['pageviews'].", ".$day['hits']."],";
                                          } ?>
    
        							<script type="text/javascript">
        						      google.load("visualization", "1", {packages:["corechart"]});
        						      google.setOnLoadCallback(drawChart);
        						      function drawChart() {
        						        var data = google.visualization.arrayToDataTable([
        						          ['<?php _e('Year','wp-power-stats') ?>', '<?php _e('Page Views','wp-power-stats') ?>', '<?php _e('Visitors','wp-power-stats') ?>'],
        						          <?php echo $data_array; ?>
        						        ]);
        						
        						        var options = {
        						          "title": '',
        						          "backgroundColor": 'transparent',
        						          "animation": {"duration": 1000,"easing": 'out',},
        								  "colors": ['#AAAAAA', '#21759B'],
        								  "vAxis": {"title": '',"baselineColor": '#CCCCCC',"textPosition": "in","textStyle": {"bold":false,"color": '#848484',"fontSize": 9}},
        								  "hAxis": {"title": '',"textStyle": {"color": '#777777'},"showTextEvery": '2'},
        								  "legend": {"position": 'none',},
        								  "lineWidth": '2',
        								  "pointSize": '0',
        								  "focusTarget": 'category',
        								  "chartArea": {"width": '94%', "height": '70%'}
        						        };
        
        						
        						        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        						        chart.draw(data, options);
        						      }
        						      
        						      
        							  (function($) {$(document).ready(function() {
        							  	
        							  		function debouncer(func, timeout) {
        										var timeoutID, timeout = timeout || 200;
        										return function() {
        											var scope = this,
        												args = arguments;
        											clearTimeout(timeoutID);
        											timeoutID = setTimeout(function() {
        												func.apply(scope, Array.prototype.slice.call(args));
        											}, timeout);
        										}
        									}
        									
        									$(window).resize(debouncer(function(e) {drawChart();drawMap();}));
                                        
                                        });})(jQuery);
        
        						    </script>
        						    
        							<div id="chart_div" style="width: 100%; height: 260px;"></div>
    						    
    						    <?php endif ?>
    						    
    						</div><!-- inside -->
        				
        				</div><!-- postbox -->
        			</div><!-- postbox-container -->
                </div><!-- cell -->
            </div><!-- two-thirds -->
            
            
            <div class="one-third column">
                <div class="cell">
                    <div class="postbox-container">
    
                        <div class="postbox micro">
                            <h3><?php _e('Traffic Source','wp-power-stats') ?></h3>
                            <div class="inside">
                                <table class="triple">
                                    <tbody>
                                        <tr>
                                            <td><img src="<?php echo plugins_url('wp-power-stats/images/search.png') ?>" alt="<?php _e('Search Engine','wp-power-stats') ?>"></td>
                                            <td><img src="<?php echo plugins_url('wp-power-stats/images/link.png') ?>" alt="<?php _e('Link','wp-power-stats') ?>"></td>
                                            <td><img src="<?php echo plugins_url('wp-power-stats/images/direct.png') ?>" alt="<?php _e('Direct','wp-power-stats') ?>"></td>
                                        </tr>
                                        <tr>
                                            <td class="percent"><?php echo $search_engines ?><span>%</span></td>
                                            <td class="percent"><?php echo $links ?><span>%</span></td>
                                            <td class="percent"><?php echo $direct ?><span>%</span></td>
                                        </tr>
                                        <tr>
                                            <td><?php _e('Search Engine','wp-power-stats') ?></td>
                                            <td><?php _e('Links','wp-power-stats') ?></td>
                                            <td><?php _e('Direct','wp-power-stats') ?></td>
                                        </tr>
                                    </tbody>
                                </table>        
                            </div><!-- inside -->
                        </div><!-- postbox -->
                        
                        <div class="postbox micro">
                            <h3><?php _e('Browsers','wp-power-stats') ?></h3>
                            <div class="inside dense">
                                <table class="triple">
                                    <tbody>
                                        <tr>
                                            <?php foreach ($browsers as $browser) : ?><?php $browser_icon = (file_exists(plugin_dir_path(__FILE__).'../images/'.$browser['image'].'.png')) ? plugins_url('wp-power-stats/images/'.$browser['image'].'.png') : plugins_url('wp-power-stats/images/unknown.png'); ?><td><img src="<?php echo $browser_icon ?>" alt="<?php echo $browser['name'] ?>"></td><?php endforeach ?>
                                        </tr>
                                        <tr>
                                            <?php foreach ($browsers as $browser) : ?><td class="percent"><?php echo $browser['percent'] ?><span>%</span></td><?php endforeach ?>
                                        </tr>
                                        <tr>
                                            <?php foreach ($browsers as $browser) : ?><td><?php echo $browser['name'] ?></td><?php endforeach ?>
                                        </tr>
                                    </tbody>
                                </table>        
                            </div><!-- inside -->
                        </div><!-- postbox -->
                        
                        <div class="postbox micro">
                            <h3><?php _e('Operating Systems','wp-power-stats') ?></h3>
                            <div class="inside dense">
                                <table class="triple">
                                    <tbody>
                                        <tr>
                                            <?php foreach ($oss as $os) : ?><?php $os_icon = (file_exists(plugin_dir_path(__FILE__).'../images/'.$os['image'].'.png')) ? plugins_url('wp-power-stats/images/'.$os['image'].'.png') : plugins_url('wp-power-stats/images/unknown.png'); ?><td><img src="<?php echo $os_icon ?>" alt="<?php echo $os['name'] ?>"></td><?php endforeach ?>
                                        </tr>
                                        <tr>
                                            <?php foreach ($oss as $os) : ?><td class="percent"><?php echo $os['percent'] ?><span>%</span></td><?php endforeach ?>
                                        </tr>
                                        <tr>
                                            <?php foreach ($oss as $os) : ?><td><?php echo $os['name'] ?></td><?php endforeach ?>
                                        </tr>
                                    </tbody>
                                </table>        
                            </div><!-- inside -->
                        </div><!-- postbox -->
                        
                        
                    </div><!-- postbox-container -->
                </div><!-- cell -->
            </div><!-- one-third -->
            
            <div class="two-thirds column">
                <div class="cell">
    
    
        			<div class="postbox-container">
    					<div class="postbox triple-height">
    						<h3><span><?php _e('Visitor Map','wp-power-stats') ?></span></h3>
    					
    						<div class="inside">
    
								<?php
									
								$country_data_array = "";
								
								if (is_array($country_data) && !empty($country_data)) {
									foreach ($country_data as $country) {
										$country_data_array .= "['".$country['name']."', ".$country['count']."],";
									}
								}

								?>

								<script type="text/javascript">
							       google.load('visualization', '1', {'packages': ['geochart']});
								   google.setOnLoadCallback(drawMap);
								
								    function drawMap() {
								      var data = google.visualization.arrayToDataTable([
								        ['Country', 'Popularity'],
								        <?php echo $country_data_array ?>
								      ]);
								
								      var options = {
										  backgroundColor: 'transparent',
									      dataMode: 'regions',
									      colors: ['#C5D8E0','#00618C']
								      };
								
								      var container = document.getElementById('map_canvas');
								      var geomap = new google.visualization.GeoChart(container);
								      geomap.draw(data, options);
								      
								  };

							    </script><div id="map_canvas" style=" height: 405px; width: 100%; text-align: center; margin: auto;"></div>
    						    
    						</div><!-- inside -->
        				
        				</div><!-- postbox -->
        			</div><!-- postbox-container -->
                </div><!-- cell -->
            </div><!-- two-thirds -->
            
            <div class="one-third column">
                <div class="cell">
                    <div class="postbox-container">
    
                        <div class="postbox fit-height">
                            <h3><?php _e('Top Posts','wp-power-stats') ?></h3>
                            <div class="inside">
                                <table>
                                    <tbody>

                                        <?php $i=1; foreach ($top_posts as $post): ?>
        								<tr><td class="order"><?php echo $i ?>.</td><td class="link"><a href="<?php echo get_permalink($post['post_id']) ?>"><?php echo trim_text($post['title'], 45) ?></a></td></tr>
        								<?php $i++; endforeach; ?>

                                    </tbody>
                                </table>        
                            </div><!-- inside -->
                        </div><!-- postbox -->
                        
                    </div><!-- postbox-container -->
                </div><!-- cell -->
            </div><!-- one-third -->
            
            <div class="two-thirds column">
                <div class="cell">
                
                    <div class="half column">
                        <div class="cell">
                        
                			<div class="postbox-container">
            					<div class="postbox fit-height">
            						<h3><span><?php _e('Top Links','wp-power-stats') ?></span></h3>
            						<div class="inside">
                                        <table>
                                            <tbody>
                								<?php $i=1; foreach ($top_links as $link): ?>
                								<tr><td class="order"><?php echo $i ?>.</td><td class="link"><a href="<?php echo $link['referer'] ?>" target="_blank"><?php echo trim_text($link['referer'], 45) ?></a></td></tr>
                								<?php $i++; endforeach; ?>
                                            </tbody>
                                        </table>
            						</div><!-- inside -->
                				</div><!-- postbox -->
                            </div><!-- postbox-container -->
                            
                        </div><!-- cell -->
                    </div><!-- half -->
                    
                    <div class="half column last">
                        <div class="cell">
                
                            <div class="postbox-container">
            					<div class="postbox fit-height">
            						<h3><span><?php _e('Top Search Terms','wp-power-stats') ?></span></h3>
            						<div class="inside">
                                        <table>
                                            <tbody>
                								<?php $i=1; foreach ($top_searches as $search): ?>
                								<tr><td class="order"><?php echo $i ?>.</td><td class="link"><?php echo trim_text($search['terms'], 45) ?></td></tr>
                								<?php $i++; endforeach; ?>
                                            </tbody>
                                        </table>
            						</div><!-- inside -->
                				</div><!-- postbox -->
                            </div><!-- postbox-container -->
                        </div><!-- cell -->
                    </div><!-- half -->
        			
                </div><!-- cell -->
            </div><!-- two-thirds -->
            
            <div class="clear"></div>
            
        </div><!-- metabox-holder -->
    </div><!-- container -->
    
</div><!-- wrap -->