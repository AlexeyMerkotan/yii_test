
<div class="col-md-2 col-sm-2 col-xs-2" style="border: 1px solid " >
    <div  class="col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <button type="button" class="btn btn-info" id="event">New Event</button>
            </div>
        </div>

    </div>
    <div class="row" >
        <div  class="col-md-12 col-sm-12 col-xs-12 " >
            <h3>User</h3>
            <?php foreach ($model as $value):?>
                <div class="checkbox user " style="background:<?=$value->color?>;">
                    <label>
                        <input type="checkbox" value="<?=$value->id?>" checked> <?=$value->name;?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3>Project</h3>
            <?php foreach ($project as $value):?>
                <div class="checkbox project">
                    <label>
                        <input type="checkbox"   value="<?=$value->id?>" checked> <?=$value->name;?>
                    </label>
                </div>
            <?php endforeach; ?></div>

    </div>
    <div  class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 15px;">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <button id="filter" type="button" class="btn btn-default">Filter</button>
            </div>
        </div>

    </div>
</div>
