<!-- filter section -->
<div class="filter-container">
    <div class="filter-row">
        <form action="" method="POST" style="display: flex; gap: 20px; flex-wrap: wrap;">
            <div class="filter-group">
                <label>Select Month</label>
                <input type="month" name="month-sort">
            </div>
            <div class="filter-group">
                <label>Range From</label>
                <input type="date" name="range-from">
            </div>
            <div class="filter-group">
                <label>Range To</label>
                <input type="date" name="range-to">
            </div>
            <div class="filter-group" style="margin-top: 25px;">
                <button type="submit" class="primary" name="sort-submit"><i class="fa fa-filter"></i> Filter</button>
            </div>
            <div class="filter-group" style="margin-top: 25px;">
                <a href="invoice.php" class="success"><i class="fa fa-retweet"></i> Reset</a>
            </div>
        </form>
    </div>
</div>
<!-- End filter section -->


<!-- scroll cards to show information  -->
<div class="scroll-data">
    <div class="single-data invoice ">
        <div class="counter-name">
            <span><?php echo TotalInvoice();?></span>
            <h4>Total Invoice</h4>
        </div>
        <div class="symbol">
            <i class="fa fa-file-pdf"></i>
        </div>
    </div>

    <div class="single-data success">
        <div class="counter-name">
            <span>₦<?php echo TotalSales();?></span>
            <h4>Total Sales</h4>
        </div>
        <div class="symbol">
            <i class="fa fa-store"></i>
        </div>
    </div>

    <div class="single-data primary">
        <div class="counter-name">
            <span>₦<?php echo ThisMonth();?></span>
            <h4>This Month</h4>
        </div>
        <div class="symbol">
            <i class="fa fa-calendar"></i>
        </div>
    </div>
    <div class="single-data info">
        <div class="counter-name">
            <span>₦0</span>
            <h4>Today Sales</h4>
        </div>
        <div class="symbol">
            <i class="fa fa-calendar-check"></i>
        </div>
    </div>
</div>