<div class="container">
    <div class="col-sm-12 no-padding ACCOUNT-HEADER-FOLD-CONTENT">
         <span class="hidden-xs">
            <div class="col-sm-3">
                <h4>Total Files</h4>
                <p>{{ $fileCount }}</p>
            </div>
            <div class="col-sm-3">
                <h4>Total Sales</h4>
                <p>{{ $saleCount }}</p>
            </div>
            <div class="col-sm-3">
                <h4>Commission This Month</h4>
                <p>${{ $thisMonthCommission }}</p>
            </div>
            <div class="col-sm-3">
                <h4>Lifetime Commission</h4>
                <p>${{ $lifetimeCommission }}</p>
            </div>
         </span>
        <span class="visible-xs">
            <div class="STAT-BOX">
                <p>Total Files: <span class="pull-right">{{ $fileCount }}</span></p>
            </div>
            <div class="STAT-BOX">
                <p>Total Sales: <span class="pull-right">{{ $saleCount }}</span></p>
            </div>
            <div class="STAT-BOX">
                <p>Commission This Month: <span class="pull-right">${{ $thisMonthCommission }}</span></p>
            </div>
            <div class="STAT-BOX">
                <p>Lifetime Commission: <span class="pull-right">${{ $lifetimeCommission }}</span></p>
            </div>
        </span>
    </div>
</div>