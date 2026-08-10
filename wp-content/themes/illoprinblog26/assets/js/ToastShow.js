class ToastShow {
  static shown = false;
  static closeTimeout = null;

  static ShowToast(type = 'info', messageHTML = 'info', defaultConfig = {}) {
    if (ToastShow.shown) return;

    const config = {
      elem: document.querySelector('.toast'),
      classes: {
        info: "toast-info",
        success: "toast-success",
        danger: "toast-accent",
        show: "show",
        hide: "hide",
      },
      messageSelector: '.toast-body',
      iconSelector: '.toast-icon',
      buttonCloseSelector: '#toast-close',
      buttonCopySelector: '#toast-copy',
      interval: 3000,
      icons: {
        info: `<i class="bi bi-info-circle-fill"></i>`,
        danger: `<i class="bi bi-x-circle-fill"></i>`,
        success: `<i class="bi bi-check-circle-fill"></i>`,
      },
      reduceMotion: false,
      ...defaultConfig,
    };

    const toast = config.elem;
    const message = toast.querySelector(config.messageSelector);
    const icon = toast.querySelector(config.iconSelector);
    const btnClose = toast.querySelector(config.buttonCloseSelector);
    const btnCopy = toast.querySelector(config.buttonCopySelector);
    
    if (!message) return;    

    // Сбрасываем старые типы перед показом
    toast.classList.remove(...Object.values(config.classes));

    // Наполнение контентом
    message.innerHTML = messageHTML;
    if (icon) icon.innerHTML = config.icons[type];
    
    // Показываем тост
    toast.classList.add(config.classes[type], config.classes.show);
    ToastShow.shown = true;

    // Функция копирования сообщения 
    const copy = () => {
      navigator.clipboard.writeText(message.textContent);
    }

    // Единая функция закрытия (инкапсулирует всю логику)
    const close = () => {
      // Очищаем таймер, если закрыли вручную по кнопке
      clearTimeout(ToastShow.closeTimeout);
      
      // Удаляем слушатель клика, если закрылось автоматически по таймеру
      if (btnClose) {
        btnClose.removeEventListener('click', close);
      }

      // Удаляем слушатель с кнопки копирования
      if (btnCopy) {
        btnCopy.removeEventListener('click', copy);
      }

      // Скрываем элемент без анимации, если prefers-reduced-motion
      if (config.reduceMotion) {
        toast.classList.remove(config.classes.show);
        ToastShow.shown = false;
        return;
      }

      // Запускаем анимацию
      toast.classList.add(config.classes.hide);

      // Чистим DOM после анимации
      toast.addEventListener('animationend', () => {
        toast.classList.remove(config.classes.show, config.classes.hide);
        ToastShow.shown = false;
      }, { once: true });
    };

    // Вешаем событие на кнопку закрытия
    if (btnClose) {
      btnClose.addEventListener('click', close);
    }

    // Вешаем события на копирование сообщения
    if (btnCopy) {
      btnCopy.addEventListener('click', copy);
    }

    // Запускаем авто-скрытие
    ToastShow.closeTimeout = setTimeout(close, config.interval);
  }
}
