<section id="membership">
			<div class="grid-block">
				<div class="grid-box width33 grid-h">
					<?php echo $this['modules']->render('membership-trial-1', array('layout'=>$this['config']->get('membership-trial-1'))); ?>	
				</div>
				<div class="grid-box width33 grid-h">
					<?php echo $this['modules']->render('membership-trial-2', array('layout'=>$this['config']->get('membership-trial-2'))); ?>	
				</div>
				<div class="grid-box width33 grid-h">
					<?php echo $this['modules']->render('membership-trial-3', array('layout'=>$this['config']->get('membership-trial-3'))); ?>	
				</div>
			</div>
			</section>