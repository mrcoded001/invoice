<!-- Notifications alert -->
<script>
  function showNotification(message, type = 'success') {
    const container = document.getElementById('notification-containers');

    const iconMap = {
      success: '✔️',
      error: '❌',
      warning: '⚠️',
      info: 'ℹ️'
    };

    const toaster = document.createElement('div');
    toaster.className = `toaster ${type}`;
    toaster.innerHTML = `
      <span class="icon">${iconMap[type] || ''}</span>
      ${message}
      <span class="close-btn" onclick="this.parentElement.remove()">×</span>
    `;

    container.appendChild(toaster);

    setTimeout(() => {
      toaster.remove();
    }, 4000); // auto-dismiss
  }

  // Load it after DOM is ready
  document.addEventListener("DOMContentLoaded", function () {
    <?php if (isset($_SESSION['message'])): ?>
      showNotification("<?= $_SESSION['message'] ?>", "<?= $_SESSION['type'] ?>");
    <?php unset($_SESSION['message'], $_SESSION['type']); endif; ?>
  });

</script>