<?

class Form
{
  public function __construct($additional_class = '')
  {
    echo '
    <div class="block-form">
      <div class="form">
        <h3 class="title">Оставьте заявку</h3>
        <div class="field ym-record-keys">
          <label for="form-name">Имя:</label>
          <input type="text" id="form-name" placeholder="Введите имя"/>
        </div>
        <div class="field ym-record-keys">
          <label for="form-email">E-mail:</label>
          <input type="email" id="form-email" class="ym-record-keys" placeholder="Введите e-mail"/>
        </div>
        <div class="field ym-record-keys">
          <label for="form-phone">Телефон*:</label>
          <input type="text" id="form-phone" class="ym-record-keys" placeholder="Введите телефон"/>
        </div>
        <div class="field ym-record-keys">
          <label for="form-message">Сообщение:</label>
          <textarea type="text" rows="3" id="form-message" class="ym-record-keys" placeholder="Введите сообщение"></textarea>
        </div>
        <div class="form-footer">
          <input type="checkbox" id="form-privacy" checked/>
          <label for="form-privacy">
          Согласен на обработку персональных данных в соответствии с <a href="/privacy" target="_blank">Политикой конфиденциальности</a>.
          </label>
          <div class="form-submit btn">Отправить</div>
        </div>
        <div class="close-icon">×</div>
        <div class="overlay">
          <div class="spinner"></div>
          <div class="response"></div>
        </div>
      </div>
    </div>
    ';
  }
}
