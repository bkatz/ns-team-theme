<?php

/**
 * Module: Content
 */

// Section ID and Classes
$id 			= get_sub_field('section_id');
$class 			= get_sub_field('section_class');
$section_id 	= ($id) ? $id : null;
$section_class 	= ($class) ? $class : null;

// Section Data
$content = get_sub_field('content');
?>



<section id="<?php echo $section_id; ?>" class="player-info <?php echo $section_class; ?>">
	<div class="container">
		<button id="toggleHighest">Toggle Highest</button>
		<button id="toggleLowest">Toggle Lowest</button>
		<div class="player__content">
			<?php
			$args = array(
				'post_type' => 'player',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC'
			);
			$player_query = new WP_Query($args);
			?>
			<?php if ($player_query->have_posts()) : ?>
				<div class="player-info__list">
					<h2>Positions</h2>
					<table id="player-info__positions" class="player-info__data">
						<thead>
							<th onclick="sortTable(this, 0)">Name</th>
							<th onclick="sortTable(this, 1)">P</th>
							<th onclick="sortTable(this, 2)">C</th>
							<th onclick="sortTable(this, 3)">1B</th>
							<th onclick="sortTable(this, 4)">2B</th>
							<th onclick="sortTable(this, 5)">3B</th>
							<th onclick="sortTable(this, 6)">SS</th>
							<th onclick="sortTable(this, 7)">LF</th>
							<th onclick="sortTable(this, 8)">CF</th>
							<th onclick="sortTable(this, 9)">RF</th>
							<th onclick="sortTable(this, 10)">BCH</th>
							<th onclick="sortTable(this, 11)">AP</th>
						</thead>
						<tbody>
							<?php while ($player_query->have_posts()) : $player_query->the_post();
								$positions = get_field('positions_played'); ?>
								<?php if (have_rows('positions_played')) : ?>
									<?php while (have_rows('positions_played')) : the_row();
										$p = get_sub_field('p');
										$c = get_sub_field('c');
										$b1 = get_sub_field('1b');
										$b2 = get_sub_field('2b');
										$b3 = get_sub_field('3b');
										$ss = get_sub_field('ss');
										$lf = get_sub_field('lf');
										$cf = get_sub_field('cf');
										$rf = get_sub_field('rf');
										$bch = get_sub_field('bch');
										$ap = get_sub_field('ap'); ?>
										<tr>
											<td><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></td>
											<td><?php echo $p ?></td>
											<td><?php echo $c ?></td>
											<td><?php echo $b1 ?></td>
											<td><?php echo $b2 ?></td>
											<td><?php echo $b3 ?></td>
											<td><?php echo $ss ?></td>
											<td><?php echo $lf ?></td>
											<td><?php echo $cf ?></td>
											<td><?php echo $rf ?></td>
											<td><?php echo $bch ?></td>
											<td><?php echo $ap ?></td>
										</tr>
									<?php endwhile; ?>
								<?php endif; ?>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			<?php endif; ?>

			<?php
			$args = array(
				'post_type' => 'player',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC'
			);
			$player_query = new WP_Query($args);
			?>
			<?php if ($player_query->have_posts()) : ?>
				<div class="player-info__list">
					<h2>Offensive Season Stats</h2>
					<table id="player-info__pitching" class="player-info__data">
						<thead>
							<th onclick="sortTable(this, 0)">Name</th>
							<th onclick="sortTable(this, 1)">PA</th>
							<th onclick="sortTable(this, 2)">AB</th>
							<th onclick="sortTable(this, 7)">H</th>
							<th onclick="sortTable(this, 8)">RBI</th>
							<th onclick="sortTable(this, 3)">BA</th>
							<th onclick="sortTable(this, 4)">OBP</th>
							<th onclick="sortTable(this, 5)">SLG</th>
							<th onclick="sortTable(this, 6)">OPS</th>
						</thead>
						<tbody>

							<?php while ($player_query->have_posts()) : $player_query->the_post(); ?>
								<?php if (have_rows('offensive_stats_season')) :
									$total_ave = 0;
									$total_obp = 0;
									$total_slg = 0;
									$total_ops = 0;
									$total_pa = 0;
									$total_at_bat = 0;
									$total_hits = 0;
									$total_b1 = 0;
									$total_b2 = 0;
									$total_b3 = 0;
									$total_hr = 0;
									$total_w = 0;
									$total_hp = 0;
									$total_so = 0;
									$total_ho = 0;
									$total_fc = 0;
									$total_sf = 0;
									$total_rbi = 0;
									$count = 0; ?>
									<?php while (have_rows('offensive_stats_season')) : the_row();
										$b1 = get_sub_field('1b');
										$b2 = get_sub_field('2b');
										$b3 = get_sub_field('3b');
										$hr = get_sub_field('hr');
										$w = get_sub_field('w');
										$hp = get_sub_field('hp');
										$so = get_sub_field('so');
										$ho = get_sub_field('ho');
										$fc = get_sub_field('fc');
										$sf = get_sub_field('sf');
										$rbi = get_sub_field('rbi');
										$pa = $b1 + $b2 + $b3 + $hr + $w + $hp + $so + $ho + $fc + $sf;
										$at_bat = $b1 + $b2 + $b3 + $hr + $so + $ho + $fc;
										$hits = $b1 + $b2 + $b3 + $hr;
										$ave = $hits / $at_bat;
										$ave = number_format($ave, 3, '.', '');
										$obp = ($hits + $w + $hp) / $pa;
										$obp = number_format($obp, 3, '.', '');
										$slg = ($b1 + $b2 * 2 + $b3 * 3 + $hr * 4) / $at_bat;
										$slg = number_format($slg, 3, '.', '');
										$ops = $obp + $slg;

										$total_ave += $ave;
										$total_obp += $obp;
										$total_slg += $slg;
										$total_ops += $ops;
										$total_pa += $pa;
										$total_at_bat += $at_bat;
										$total_hits += $hits;
										$total_b1 += $b1;
										$total_b2 += $b2;
										$total_b3 += $b3;
										$total_hr += $hr;
										$total_w += $w;
										$total_hp += $hp;
										$total_so += $so;
										$total_ho += $ho;
										$total_fc += $fc;
										$total_sf += $sf;
										$total_rbi += $rbi;
										$count++; ?>
									<?php endwhile;
									// Calculate the average
									if ($count > 0) {
										$total_ave = number_format($total_hits / $total_at_bat, 3, '.', '');
										$total_obp = number_format(($total_hits + $total_w + $total_hp) / $total_pa, 3, '.', '');
										$total_slg = number_format(($total_b1 + $total_b2 * 2 + $total_b3 * 3 + $total_hr * 4) / $total_at_bat, 3, '.', '');
										$total_ops = number_format($total_obp + $total_slg, 3, '.', '');
									} else {
										$total_ave = '0.000';
										$total_obp = '0.000';
										$total_slg = '0.000';
										$total_ops = '0.000';
									} ?>
									<tr>
										<td><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></td>
										<td><?php echo $total_pa ?></td>
										<td><?php echo $total_at_bat ?></td>
										<td><?php echo $total_hits ?></td>
										<td><?php echo $total_rbi ?></td>
										<td><?php echo $total_ave ?></td>
										<td><?php echo $total_obp ?></td>
										<td><?php echo $total_slg ?></td>
										<td><?php echo $total_ops ?></td>
									</tr>
								<?php endif; ?>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			<?php endif; ?>

			<?php
			$args = array(
				'post_type' => 'player',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC'
			);
			$player_query = new WP_Query($args);
			?>
			<?php if ($player_query->have_posts()) : ?>
				<div class="player-info__list">
					<h2>Pitching Season Stats</h2>
					<table id="player-info__pitching" class="player-info__data">
						<thead>
							<th onclick="sortTable(this, 0)">Name</th>
							<th onclick="sortTable(this, 1)">ERA</th>
							<th onclick="sortTable(this, 2)">WHIP</th>
							<th onclick="sortTable(this, 3)">K/4</th>
							<th onclick="sortTable(this, 4)">BB/4</th>
							<th onclick="sortTable(this, 5)">K:BB</th>
							<th onclick="sortTable(this, 6)">PC/4</th>
							<th onclick="sortTable(this, 7)">IP</th>
							<th onclick="sortTable(this, 8)">K</th>
							<th onclick="sortTable(this, 9)">BB</th>
							<th onclick="sortTable(this, 10)">PC</th>
						</thead>
						<tbody>

							<?php while ($player_query->have_posts()) : $player_query->the_post(); ?>
								<?php if (have_rows('pitching_stats_season')) :
									$total_era = 0;
									$total_whip = 0;
									$total_k4 = 0;
									$total_bb4 = 0;
									$total_kbb = 0;
									$total_pc4 = 0;
									$total_hits = 0;
									$total_ip = 0;
									$total_k = 0;
									$total_h = 0;
									$total_bb = 0;
									$total_hbp = 0;
									$total_r = 0;
									$total_er = 0;
									$total_pc = 0;
									$count = 0; ?>
									<?php while (have_rows('pitching_stats_season')) : the_row();
										$ip = get_sub_field('ip');
										$k = get_sub_field('k');
										$k = $k ? $k : 0;
										$h = get_sub_field('h');
										$h = $h ? $h : 0;
										$bb = get_sub_field('bb');
										$bb = $bb ? $bb : 0;
										$hbp = get_sub_field('hbp');
										$hbp = $hbp ? $hbp : 0;
										$r = get_sub_field('r');
										$r = $r ? $r : 0;
										$er = get_sub_field('er');
										$er = $er ? $er : 0;
										$pc = get_sub_field('pc');
										if ($er === 0 || $ip == 0) {
											$era = 0;
										} else {
											$era = ($er / $ip) * 4;
										}
										$whip = ($h + $bb + $hbp) / $ip;
										$k4 = ($k * 4) / $ip;
										$bb4 = (($bb + $hbp) * 4) / $ip;
										$kbb = $k / ($bb + $hbp);
										$pc4 = ($pc / $ip) * 4;

										$total_era += $era;
										$total_whip += $whip;
										$total_k4 += $k4;
										$total_bb4 += $bb4;
										$total_kbb += $kbb;
										$total_pc4 += $pc4;
										$total_hits += $hits;
										$total_ip += $ip;
										$total_k += $k;
										$total_h += $h;
										$total_bb += $bb;
										$total_hbp += $hbp;
										$total_r += $r;
										$total_er += $er;
										$total_pc += $pc;
										$count++; ?>
									<?php endwhile;
									// Calculate the average
									if ($count > 0) {
										$total_era = number_format(($total_er / $total_ip) * 4, 2, '.', '');
										$total_whip = number_format(($total_h + $total_bb + $total_hbp) / $total_ip, 2, '.', '');
										$total_k4 = number_format(($total_k / $total_ip) * 4, 2, '.', '');
										$total_bb4 = number_format(($total_bb / $total_ip) * 4, 2, '.', '');
										$total_kbb = number_format($total_k / $total_bb, 2, '.', '');
										$total_pc4 = number_format(($total_pc / $total_ip) * 4, 0, '.', '');
									} else {
										$total_era = '0.000';
										$total_whip = '0.000';
										$total_k4 = '0.000';
										$total_bb4 = '0.000';
										$total_kbb = '0.000';
										$total_pc4 = '0.000';
									} ?>
									<tr>
										<td><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></td>
										<td><?php echo $total_era ?></td>
										<td><?php echo $total_whip ?></td>
										<td><?php echo $total_k4 ?></td>
										<td><?php echo $total_bb4 ?></td>
										<td><?php echo $total_kbb ?></td>
										<td><?php echo $total_pc4 ?></td>
										<td><?php echo $total_ip ?></td>
										<td><?php echo $total_k ?></td>
										<td><?php echo $total_bb ?></td>
										<td><?php echo $total_pc ?></td>
									</tr>
								<?php endif; ?>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			<?php endif; ?>
		</div>
	</div>

</section><!-- .player-info -->

<script>
	function sortTable(th, column) {
		var table = th.closest('table');
		var rows, i, x, y, shouldSwitch, dir = "asc",
			switchcount = 0;
		switching = true;

		// Remove highlighted class from all headers
		var headers = table.getElementsByTagName("TH");
		for (i = 0; i < headers.length; i++) {
			headers[i].classList.remove("highlighted");
		}
		// Remove highlighted class from all cells
		rows = table.getElementsByTagName("TR");
		for (i = 0; i < rows.length; i++) {
			var cells = rows[i].getElementsByTagName("TD");
			for (j = 0; j < cells.length; j++) {
				cells[j].classList.remove("highlighted");
			}
		}

		// Add highlighted class to the current header
		th.classList.add("highlighted");

		while (switching) {
			switching = false;
			rows = table.getElementsByTagName("TR");

			for (i = 1; i < rows.length - 1; i++) {
				shouldSwitch = false;
				x = rows[i].getElementsByTagName("TD")[column];
				y = rows[i + 1].getElementsByTagName("TD")[column];

				var xContent = x.innerHTML.toLowerCase();
				var yContent = y.innerHTML.toLowerCase();

				// Attempt to convert content to a number for sorting, if applicable
				var xVal = parseFloat(xContent);
				var yVal = parseFloat(yContent);
				if (!isNaN(xVal) && !isNaN(yVal)) {
					xContent = xVal;
					yContent = yVal;
				}

				if (dir == "asc") {
					if (xContent > yContent) {
						shouldSwitch = true;
						break;
					}
				} else if (dir == "desc") {
					if (xContent < yContent) {
						shouldSwitch = true;
						break;
					}
				}
			}
			if (shouldSwitch) {
				rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
				switching = true;
				switchcount++;
			} else {
				if (switchcount == 0 && dir == "asc") {
					dir = "desc";
					switching = true;
				} else if (switchcount > 0) {
					dir = "asc"; // Reset direction after a successful sort
				}
			}
		}

		// Optionally, highlight all cells in the sorted column
		for (i = 1; i < rows.length; i++) { // Start at 1 to skip the header row
			rows[i].getElementsByTagName("TD")[column].classList.add("highlighted");
		}
	}


	document.addEventListener("DOMContentLoaded", function() {
		function applyOrRemoveHighlight(columnSelector, type) {
			const tds = document.querySelectorAll(columnSelector);
			let valueToCompare = type === 'highest' ? Number.MIN_SAFE_INTEGER : Number.MAX_SAFE_INTEGER;
			const comparisonFunc = type === 'highest' ? Math.max : Math.min;
			let highlightApplied = false;

			// Determine the value to compare and if any highlight is already applied
			tds.forEach(td => {
				const value = Number(td.textContent);
				valueToCompare = comparisonFunc(valueToCompare, value);
				if (td.dataset.highlighted === type) {
					highlightApplied = true; // Found an already highlighted td
				}
			});

			// Apply or remove the highlight based on the current state
			tds.forEach(td => {
				const value = Number(td.textContent);
				if (value === valueToCompare) {
					if (highlightApplied) {
						// Remove highlight
						td.style.boxShadow = "";
						delete td.dataset.highlighted;
					} else {
						// Apply highlight
						td.style.boxShadow = type === 'highest' ? "inset 0 0 5px 2px #99abf0" : "inset 0 0 5px 2px #f1cdcd";
						td.dataset.highlighted = type; // Track the highlight state using a data attribute
					}
				}
			});
		}

		// Toggle event for highlighting the highest values
		document.getElementById("toggleHighest").addEventListener("click", function() {
			applyOrRemoveHighlight('#player-info__pitching td:nth-child(4)', 'highest');
			applyOrRemoveHighlight('#player-info__pitching td:nth-child(5)', 'highest');
			applyOrRemoveHighlight('#player-info__pitching td:nth-child(6)', 'highest');
			applyOrRemoveHighlight('#player-info__pitching td:nth-child(7)', 'highest');
			applyOrRemoveHighlight('#player-info__pitching td:nth-child(8)', 'highest');
			applyOrRemoveHighlight('#player-info__pitching td:nth-child(9)', 'highest');
			// Repeat for other specified columns as needed
		});

		// Toggle event for highlighting the lowest values
		document.getElementById("toggleLowest").addEventListener("click", function() {
			applyOrRemoveHighlight('#player-info__pitching td:nth-child(4)', 'lowest');
			applyOrRemoveHighlight('#player-info__pitching td:nth-child(5)', 'lowest');
			applyOrRemoveHighlight('#player-info__pitching td:nth-child(6)', 'lowest');
			applyOrRemoveHighlight('#player-info__pitching td:nth-child(7)', 'lowest');
			applyOrRemoveHighlight('#player-info__pitching td:nth-child(8)', 'lowest');
			applyOrRemoveHighlight('#player-info__pitching td:nth-child(9)', 'lowest');
			// Repeat for other specified columns as needed
		});
	});
</script>