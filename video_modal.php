
    <div id="Video_Modal<?php echo $video_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">

    <h3 id="myModalLabel"><?php echo $row['title']; ?></h3>
    </div>
    <div class="modal-body">
				
				<video controls data-setup="{}" preload="auto" width="100%" height="400" poster="">
        
				<source src="videos/<?php echo $row['location']; ?>" type='video/mp4'>
				</video>

				
				
    </div>
    <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </div>