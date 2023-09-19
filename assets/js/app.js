const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const listElements = $$(".has-arrow");
const btnElement = $(".filter__btn");
const filterBtn = $(".filter__title");
const filterElement = $(".filter__body");
const btnLanguage = $(".footer__nav--item");
const languageElements = $(".footer__subnav");
const checkboxElement = $(".primary__checkbox");
const dropdownBtns = $$(".sidebar__body > li");
const sidebarElement = $(".sidebar");

function collapseHandler(firstElement, secondElement = "", className) {
	firstElement.onclick = () => {
		if (!firstElement.classList.contains(className)) {
			firstElement.classList.add(className);
			if (secondElement) secondElement.classList.add(className);
		} else {
			firstElement.classList.remove(className);
			if (secondElement) secondElement.classList.remove(className);
		}
	};
}
function eventHandler(
	firstElement,
	secondElement = "",
	className,
	secondClass = ""
) {
	firstElement.forEach((element) => {
		element.onclick = function (event) {
			event.preventDefault();
			if (!this.classList.contains(className)) {
				firstElement.forEach((item) => {
					item.classList.remove(className);
				});
				this.classList.add(className);
				secondElement.classList.add(secondClass);
			} else {
				this.classList.remove(className);
				secondElement.classList.remove(secondClass);
			}
		};
	});
}

collapseHandler(btnElement, filterElement, "collapse");
collapseHandler(btnLanguage, languageElements, "collapse");
collapseHandler(filterBtn, filterElement, "collapse");

eventHandler(listElements, null, "active", null);
eventHandler(dropdownBtns, sidebarElement, "active", "square");

checkboxElement.onclick = function () {
	const elements = $$(".content_checkbox");
	if (checkboxElement.checked) {
		elements.forEach((element) => {
			element.checked = true;
		});
	} else {
		elements.forEach((element) => {
			element.checked = false;
		});
	}
};

const notifyElements = $$(".dropdown__item");
notifyElements.forEach((element) => {
	if (element.classList.contains("orange")) {
		element.style.setProperty("--color", "#FF6A59");
		element.style.setProperty("--secondary-color", "#fcbbbc");
	} else if (element.classList.contains("blue")) {
		element.style.setProperty("--color", "#58BAD7");
		element.style.setProperty("--secondary-color", "#d3edf5");
	} else if (element.classList.contains("yellow")) {
		element.style.setProperty("--color", "#F0A901");
		element.style.setProperty("--secondary-color", "#fff8e7");
	} else if (element.classList.contains("green")) {
		element.style.setProperty("--color", "#56c760");
		element.style.setProperty("--secondary-color", "#c9edcc");
	} else if (element.classList.contains("grey")) {
		element.style.setProperty("--color", "#374557");
		element.style.setProperty("--secondary-color", "#eee");
	}
});

const modalBtns = $$(".js-modal__btn");
const modal = $(".modal");
const modalClose = $$(".js-modal-close");
const modalWrapped = $(".modal__wrapped");

modalBtns.forEach((element) => {
	element.onclick = function (event) {
		event.preventDefault();
		modal.classList.add("active");
	};
});

modalClose.forEach((element) => {
	element.onclick = (event) => {
		event.preventDefault();
		modal.classList.remove("active");
	};
});

modal.addEventListener("click", () => {
	modal.classList.remove("active");
});

modalWrapped.addEventListener("click", function (event) {
	event.stopPropagation();
});

const filterInputs = $$(".filter__control");
const btnClear = $(".js-btnClear");
btnClear.onclick = function () {
	filterInputs.forEach((input) => {
		switch (input.type) {
			case "select-one":
				input.selectedIndex = 0;
				break;
			default:
				input.value = "";
				break;
		}
	});
};
