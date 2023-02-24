const modalPrice = document.getElementById('modal-pay');
const price = document.getElementById('price');

if (modalPrice) {
  const cards = price.querySelectorAll(".card-price");
  cards.forEach(card => {
    const title = card.querySelector('.card-price__title').textContent;
    const price = card.querySelector('.cost-primary').textContent;

    const button = card.querySelector('.button[data-micromodal-trigger]')

    button.addEventListener('click', () => {
      modalPrice.querySelector('.modal__title span').innerHTML = title;
      modalPrice.querySelector('form').dataset.subject = `Тариф ${title}`;
      modalPrice.querySelector('form').dataset.price = price.replace(' ', '');
    });
  });
}