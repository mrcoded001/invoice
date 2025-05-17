<?php session_start();?>
<?php include'includes/header.php'; ?>
<?php include'includes/sidebar.php';?>
<?php include'includes/functions.php';?>
<?php include'includes/navbar.php'; ?>
<style>.sideNav{height:90vh;}</style>
<div class="insider">

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Always-Visible Searchable Dropdown</title>
    <style>
      .dropdown-container {
        width: 300px;
        font-family: sans-serif;
      }

      .search-box {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px 5px 0 0;
      }

      .options {
        border: 1px solid #ccc;
        border-top: none;
        max-height: 200px;
        overflow-y: auto;
        background: #fff;
      }

      .option-item {
        padding: 10px;
        cursor: pointer;
      }

      .option-item:hover {
        background-color: #f0f0f0;
      }

      .selected-display {
        margin-top: 10px;
        font-weight: bold;
        color: green;
      }
    </style>
  </head>
  <body>

    <?php 
    if (isset($_POST['sub-btn'])) {
      $quantity = $_POST['quantity'];
      $product  = $_POST['product'];

      echo "You selected, quantity:$quantity, and product name is: $product";
    }

    ?>

  <form action="" method="POST">
    <label>Quantity:</label>
    <input type="number" name="quantity" placeholder="Enter quantity">

    <button type="submit" class="btn btn-primary" name="sub-btn">Submit</button><br><br>
    <!-- Other form fields -->
    <label>Product:</label>
    <div class="dropdown-container">
      <input type="text" class="search-box" id="searchBox" placeholder="Search for product..." oninput="filterOptions()" onclick="showOptions()">
      <div class="options" id="optionsList">
        <div class="option-item" onclick="selectOption('Laptop')">Laptop</div>
        <div class="option-item" onclick="selectOption('Mouse')">Mouse</div>
        <div class="option-item" onclick="selectOption('Keyboard')">Keyboard</div>
        <div class="option-item" onclick="selectOption('Monitor')">Monitor</div>
        <div class="option-item" onclick="selectOption('USB Drive')">USB Drive</div>
        <div class="option-item" onclick="selectOption('My computer')">My computer</div>
      </div>
    </div>

    <!-- Hidden input for form submission -->
    <input type="hidden" name="product" id="selectedValue">

    
    

    
  </form>

  <script>
    const searchBox = document.getElementById('searchBox');
    const optionsList = document.getElementById('optionsList');
    const selectedValue = document.getElementById('selectedValue');

    function showOptions() {
      optionsList.style.display = 'block';
    }

    function filterOptions() {
      let input = searchBox.value.toLowerCase();
      let options = document.querySelectorAll('.option-item');
      optionsList.style.display = 'block'; // Always show when typing

      options.forEach(option => {
        let text = option.textContent.toLowerCase();
        option.style.display = text.includes(input) ? 'block' : 'none';
      });
    }

    function selectOption(value) {
      searchBox.value = value;
      selectedValue.value = value;
      optionsList.style.display = 'none';
    }

    // Optional: hide when clicking outside
    document.addEventListener('click', function(event) {
      if (!event.target.closest('.dropdown-container')) {
        optionsList.style.display = 'none';
      }
    });
  </script>


  </body>
  </html>




</div>

  

  <script>
    document.getElementById("myForm").addEventListener("submit", function(e){
      e.preventDefault();
      let form = e.target;
      let formData = new FormData(form);

      fetch("fetch.php",{
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        document.getElementById('response').innerHTML = data;
        form.reset();
      })
      .catch(error =>{
        document.getElementById('response').innerHTML = "Error Submission";
      })
    })
  </script>
</div>