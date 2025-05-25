document.addEventListener('DOMContentLoaded', () => {
  const lastnameInput = document.getElementById('lastname');
  const suggestions = document.getElementById('suggestions');
  const timeInput = document.getElementById('time');

  lastnameInput.addEventListener('input', async () => {
    const query = lastnameInput.value.trim();
    if (query.length < 2) {
      suggestions.style.display = 'none';
      return;
    }

    try {
      const response = await fetch(`../controllers/search_lastname.php?q=${encodeURIComponent(query)}`);
      const results = await response.json();

      suggestions.innerHTML = '';
      if (results.length > 0) {
        results.forEach(lastname => {
          const li = document.createElement('li');
          li.textContent = lastname;
          li.className = 'list-group-item list-group-item-action';
          li.addEventListener('click', () => {
            lastnameInput.value = lastname;
            suggestions.style.display = 'none';
          });
          suggestions.appendChild(li);
        });
        suggestions.style.display = 'block';
      } else {
        suggestions.style.display = 'none';
      }
    } catch (error) {
      console.error('Error:', error);
    }
  });

  document.addEventListener('click', (e) => {
    if (!suggestions.contains(e.target) && e.target !== lastnameInput) {
      suggestions.style.display = 'none';
    }
  });

  // Prevent duplicate department selection
  document.querySelector('form').addEventListener('submit', function (e) {
    const from = document.getElementById('select1').value;
    const to = document.getElementById('select2').value;
    const submitBtn = this.querySelector('button[type="submit"]');

    if (from === to) {
      e.preventDefault();
      alert("From and To departments must be different.");
      return;
    }

    submitBtn.disabled = true;
    submitBtn.innerText = "Submitting...";
  });

  // Set default time
  function getCurrentTime() {
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    return `${hours}:${minutes}`;
  }

  if (timeInput) {
    timeInput.value = getCurrentTime();

    function canShowPicker(input) {
      return typeof input.showPicker === 'function';
    }

    timeInput.addEventListener('click', () => {
      if (canShowPicker(timeInput)) {
        timeInput.showPicker();
      } else {
        timeInput.focus();
      }
    });
  }
});