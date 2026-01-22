<!-- BEGIN: MAIN -->
<div class="alert alert-info">
	<div class="customrelated-container">
		<h3 class="fs-5 my-2">{PHP.L.featuredpagesmarket_edit_title}</h3>
		<!-- BEGIN: FEATUREDPRO_ARTICLES_ROW -->
		<div class="customrelated-row mb-3">
			<label class="form-label">
				{PHP.L.featuredpagesmarket_item_number} {FEATUREDPRO_ARTICLES_NUM}
			</label>
			<div class="input-group">
			
				<!-- Это поле отправляется на сервер -->
				<input type="hidden"
					   name="featured_article_id[{FEATUREDPRO_ARTICLES_INDEX}]"
					   class="customrelated-id"
					   value="{FEATUREDPRO_ARTICLES_TO_ID}" />

				<!-- select ТОЛЬКО для интерфейса, name убираем полностью -->
				<select class="customrelated-select-articles "
						data-placeholder="{PHP.L.featuredpagesmarket_selectpage_hint}">
					<!-- IF {FEATUREDPRO_ARTICLES_TO_ID} > 0 -->
					<option value="{FEATUREDPRO_ARTICLES_TO_ID}" selected>{FEATUREDPRO_ARTICLES_TO_TITLE}</option>
					<!-- ENDIF -->
				</select>
			</div>
			<small class="form-text text-muted">
				{PHP.L.featuredpagesmarket_min_search}
			</small>
		</div>
		<!-- END: FEATUREDPRO_ARTICLES_ROW -->
	</div>
</div>
<style>
/* стили формы селектора, они работают, но тут чисто для примера, отредактировать под себя */
/* Основной контейнер для одиночного select2 (не multiple) */
.select2-container--default .select2-selection--single {
  background-color: var(--bs-body-bg, #fff); /* Цвет фона зависит от темы Bootstrap (по умолчанию — белый) */
  border: 1px solid var(--bs-border-color, #ced4da); /* Граница: используем переменную Bootstrap или серый fallback */
  border-radius: 0.375rem; /* Скруглённые углы (6px при rem=16px) */
  padding: 0.375rem 0.75rem; /* Вертикальный и горизонтальный отступ внутри */
  font-size: 1rem; /* Размер шрифта 16px */
  line-height: 1.5; /* Межстрочный интервал — для вертикального выравнивания */
  height: 38px; /* Фиксированная высота — согласована с input Bootstrap */
  display: flex; /* Используем flexbox для выравнивания содержимого */
  align-items: center; /* Вертикальное центрирование */
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; /* Плавная анимация при фокусе */
}

/* Стили при фокусе на select2 (имитация Bootstrap input focus) */
.select2-container--default .select2-selection--single:focus {
  border-color: #86b7fe; /* Цвет рамки при фокусе (голубой Bootstrap) */
  box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25); /* Эффект свечения вокруг рамки */
  outline: 0; /* Убираем дефолтную обводку */
}

/* Стили для текста выбранного значения в select2 */
.select2-container--default .select2-selection--single .select2-selection__rendered {
  color: var(--bs-body-color, #212529); /* Цвет текста — зависит от темы, по умолчанию почти чёрный */
  line-height: 1.5; /* Центрируем текст по высоте */
  padding-left: 0; /* Убираем лишние внутренние отступы */
  padding-right: 0;
  white-space: nowrap; /* Не переносим строку */
  overflow: hidden; /* Обрезаем, если текст слишком длинный */
  text-overflow: ellipsis; /* Добавляем троеточие */
}

/* Стрелочка справа (открытие списка) */
.select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 100%; /* Занимает всю высоту блока */
  right: 0.75rem; /* Смещена вправо на 12px */
}

/* Стили выпадающего списка */
.select2-container--default .select2-results__options {
  max-height: 50vh!important; /* Ограничение по высоте для прокрутки */
  overflow-y: auto; /* Вертикальный скролл при переполнении */
  background-color: var(--bs-body-bg, #fff); /* Фон списка из темы */
  color: var(--bs-body-color, #212529); /* Цвет текста — по теме */
}

/* Подсветка пункта при наведении или клавиатурной навигации */
.select2-container--default .select2-results__option--highlighted[aria-selected] {
  background-color: var(--bs-link-hover-color, #FF5722); /* Цвет фона — оранжевый по умолчанию */
  color: #fff; /* Белый текст для контраста */
}

/* Стили для родительских категорий в select2 (группы) */
.select2-container--default .select2-results__group {
  font-weight: bold; /* Делаем жирным текст родительских категорий */
  padding: 0.375rem 0.75rem; /* Добавляем немного отступа */
  color: var(--bs-body-color, #212529); /* Цвет текста — стандартный */
  font-weight: bold;
  background-color: var(--bs-sidebar-bg, #f8f9fa);
}
</style>
<!-- END: MAIN -->
/**
 * featuredpagesmarket.edit.tpl - Template File for the Plugin Featured Articles in Market PRO in market.edit.tpl 
 *
 * featuredpagesmarket plugin for Cotonti 0.9.26, PHP 8.4+ 
 * Filename: featuredpagesmarket.edit.tpl 
 *
 * Date: Jan 22Th, 2026 
 * @package featuredpagesmarket 
 * @version 2.7.3 
 * @author webitproff 
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff 
 * @license BSD 
 */
