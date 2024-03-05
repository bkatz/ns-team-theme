<?php

/**
 * Player Content Template.
 *
 * Populates the single.php php template.
 *
 * @package WordPress
 * @since 1.0
 */
?>



<article class="player <?php echo $post_class; ?>">

	<div class="container">

		<h1 class="player__title"><?php the_title(); ?></h1>
		<p><a href="/">Back to team</a>

		<div class="player__content">
			<div class="player-info__list">
				<h2>Offensive Season Stats</h2>
				<table id="player-info__pitching" class="player-info__data">
					<thead>
						<th>AVE</th>
						<th>OBP</th>
						<th>SLG</th>
						<th>OPS</th>
						<th>H</th>
						<th>PA</th>
						<th>AB</th>
						<th>1B</th>
						<th>2B</th>
						<th>3B</th>
						<th>HR</th>
						<th>W</th>
						<th>HP</th>
						<th>SO</th>
						<th>HO</th>
						<th>FC</th>
						<th>SF</th>
						<th>RBI</th>
					</thead>
					<tbody>
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
								<tr>
									<td><?php echo $ave ?></td>
									<td><?php echo $obp ?></td>
									<td><?php echo $slg ?></td>
									<td><?php echo $ops ?></td>
									<td><?php echo $hits ?></td>
									<td><?php echo $pa ?></td>
									<td><?php echo $at_bat ?></td>
									<td><?php echo $b1 ?></td>
									<td><?php echo $b2 ?></td>
									<td><?php echo $b3 ?></td>
									<td><?php echo $hr ?></td>
									<td><?php echo $w ?></td>
									<td><?php echo $hp ?></td>
									<td><?php echo $so ?></td>
									<td><?php echo $ho ?></td>
									<td><?php echo $fc ?></td>
									<td><?php echo $sf ?></td>
									<td><?php echo $rbi ?></td>
								</tr>
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
							<tr style="border-top: 1px solid #333;">
								<td><?php echo $total_ave ?></td>
								<td><?php echo $total_obp ?></td>
								<td><?php echo $total_slg ?></td>
								<td><?php echo $total_ops ?></td>
								<td><?php echo $total_hits ?></td>
								<td><?php echo $total_pa ?></td>
								<td><?php echo $total_at_bat ?></td>
								<td><?php echo $total_b1 ?></td>
								<td><?php echo $total_b2 ?></td>
								<td><?php echo $total_b3 ?></td>
								<td><?php echo $total_hr ?></td>
								<td><?php echo $total_w ?></td>
								<td><?php echo $total_hp ?></td>
								<td><?php echo $total_so ?></td>
								<td><?php echo $total_ho ?></td>
								<td><?php echo $total_fc ?></td>
								<td><?php echo $total_sf ?></td>
								<td><?php echo $total_rbi ?></td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>

			<div class="player-info__list">
				<h2>Pitching Season Stats</h2>
				<table id="player-info__pitching" class="player-info__data">
					<thead>
						<th>ERA</th>
						<th>WHIP</th>
						<th>K/4</th>
						<th>BB/4</th>
						<th>K:BB</th>
						<th>PC/4</th>
						<th>IP</th>
						<th>K</th>
						<th>H</th>
						<th>BB</th>
						<th>HBP</th>
						<th>R</th>
						<th>ER</th>
						<th>PC</th>
					</thead>
					<tbody>
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
								<tr>
									<td><?php echo number_format($era, 2, '.', '') ?></td>
									<td><?php echo number_format($whip, 2, '.', '') ?></td>
									<td><?php echo number_format($k4, 2, '.', '') ?></td>
									<td><?php echo number_format($bb4, 2, '.', '') ?></td>
									<td><?php echo number_format($kbb, 2, '.', '') ?></td>
									<td><?php echo $pc4 ?></td>
									<td><?php echo $ip ?></td>
									<td><?php echo $k ?></td>
									<td><?php echo $h ?></td>
									<td><?php echo $bb ?></td>
									<td><?php echo $hbp ?></td>
									<td><?php echo $r ?></td>
									<td><?php echo $er ?></td>
									<td><?php echo $pc ?></td>
								</tr>
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
							<tr style="border-top: 1px solid #333;">
								<td><?php echo $total_era ?></td>
								<td><?php echo $total_whip ?></td>
								<td><?php echo $total_k4 ?></td>
								<td><?php echo $total_bb4 ?></td>
								<td><?php echo $total_kbb ?></td>
								<td><?php echo $total_pc4 ?></td>
								<td><?php echo $total_ip ?></td>
								<td><?php echo $total_k ?></td>
								<td><?php echo $total_h ?></td>
								<td><?php echo $total_bb ?></td>
								<td><?php echo $total_hbp ?></td>
								<td><?php echo $total_r ?></td>
								<td><?php echo $total_er ?></td>
								<td><?php echo $total_pc ?></td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="player__content">
			<div class="player-info__list">
				<h2>Positions</h2>
				<table id="player-info__positions" class="player-info__data">
					<thead>
						<th>P</th>
						<th>C</th>
						<th>1B</th>
						<th>2B</th>
						<th>3B</th>
						<th>SS</th>
						<th>LF</th>
						<th>CF</th>
						<th>RF</th>
						<th>BCH</th>
						<th>AP</th>
					</thead>
					<tbody>
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
					</tbody>
				</table>
			</div>
		</div>

		<div class="player__content">
			<?php if (have_rows('general_notes')) : ?>
				<?php while (have_rows('general_notes')) : the_row(); ?>
					<?php echo '<div class="notes"><h3>Batting</h3>' . get_sub_field('batting') . '</div>'; ?>
					<?php echo '<div class="notes"><h3>Baserunning</h3>' . get_sub_field('baserunning') . '</div>'; ?>
					<?php echo '<div class="notes"><h3>Grounders</h3>' . get_sub_field('grounders') . '</div>'; ?>
					<?php echo '<div class="notes"><h3>Flyballs</h3>' . get_sub_field('flyballs') . '</div>'; ?>
					<?php echo '<div class="notes"><h3>Playing Catch</h3>' . get_sub_field('play_catch') . '</div>'; ?>
					<?php echo '<div class="notes"><h3>Pitcher</h3>' . get_sub_field('pitching') . '</div>'; ?>
					<?php echo '<div class="notes"><h3>Catcher</h3>' . get_sub_field('catching') . '</div>'; ?>
					<?php echo '<div class="notes"><h3>Situational</h3>' . get_sub_field('situational') . '</div>'; ?>
					<?php echo '<div class="notes"><h3>General Notes</h3>' . get_sub_field('general_notes') . '</div>'; ?>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

	</div><!-- .player__article -->

</article><!-- .player -->