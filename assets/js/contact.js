const form = document.getElementById('contactForm');
const submitBtn = document.getElementById('submitBtn');
const loader = document.getElementById('loader');
const successMessage = document.getElementById('successMessage');
const errorMessage = document.getElementById('errorMessage');

function showLoader(on = true) {
  if (on) { loader.classList.remove('hidden'); submitBtn.setAttribute('disabled', 'disabled'); }
  else { loader.classList.add('hidden'); submitBtn.removeAttribute('disabled'); }
}
function showSuccess(text) {
  successMessage.style.display = 'block'; successMessage.textContent = text || '✔️ Your message has been sent successfully!'; errorMessage.style.display = 'none';
}
function showError(text) {
  errorMessage.style.display = 'block'; errorMessage.textContent = text || '✖ Something went wrong. Please try again.'; successMessage.style.display = 'none';
}

form.addEventListener('submit', async (e) => {
  e.preventDefault();

  const data = {
    first_name: document.getElementById('first_name').value.trim(),
    last_name: document.getElementById('last_name').value.trim(),
    email: document.getElementById('email').value.trim(),
    phone: document.getElementById('phone').value.trim(),
    service: document.getElementById('service').value,
    message: document.getElementById('message').value.trim()
  };

  if (!data.first_name || !data.last_name || !data.email || !data.phone || !data.service || !data.message) {
    showError('Please fill out all fields.');
    return;
  }

  showLoader(true);
  showError(''); showSuccess('');

  try {
    const res = await fetch('/send-mail.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });

    const json = await res.json();
    if (res.ok && json.success) {
      showSuccess('✔️ Your message has been sent successfully!');
      form.reset();
    } else {
      showError(json.message || 'Server error while sending email.');
    }
  } catch (err) {
    console.error(err);
    showError('Network error: could not send message.');
  } finally {
    showLoader(false);
  }
});