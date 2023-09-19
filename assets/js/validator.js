const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

// - Đối tượng Validator
function Validator(options) {
	function getParent(element, selector) {
		return element.closest(selector);
	}
	let selectorRules = {};

	// - Hàm thực hiện validate
	function validate(inputElement, rule) {
		let errorMessage;
		let errorElement = getParent(
			inputElement,
			options.formGroupSelector
		).querySelector(options.errorSelector);

		// ? Lấy ra các rules của selector
		let rules = selectorRules[rule.selector];

		// ? Lặp qua từng rule & kiểm tra
		for (let index = 0; index < rules.length; ++index) {
			switch (inputElement.type) {
				case "radio":
				case "checkbox":
					errorMessage = rules[index](
						formElement.querySelector(rule.selector + ":checked")
					);
					break;
				default:
					errorMessage = rules[index](inputElement.value);
			}
			if (errorMessage) break; // ? Nếu có lỗi thì dừng vòng lặp
		}
		if (errorMessage) {
			errorElement.innerText = errorMessage;
			inputElement.closest(".form__group").classList.add("invalid");
		} else {
			errorElement.innerText = "";
			inputElement.closest(".form__group").classList.remove("invalid");
		}

		return !errorMessage;
	}

	// - Lấy element của form
	let formElement = $(options.form);

	if (formElement) {
		formElement.onsubmit = function (e) {
			// ? Bỏ hành vi mặc định của form
			e.preventDefault();

			let isFormValid = true;

			// ? Lặp qua từng rules và validate
			options.rules.forEach((rule) => {
				let inputElement = formElement.querySelector(rule.selector);
				let isValid = validate(inputElement, rule);
				if (!isValid) isFormValid = false;
			});
			console.log(isFormValid);
			if (isFormValid) {
				formElement.submit();
			}
		};

		// - Lặp qua mỗi rules và xử lý (lắng nghe sự kiện blur, input,...)
		options.rules.forEach((rule) => {
			// ? Lưu lại các rules cho mỗi input
			if (Array.isArray(selectorRules[rule.selector])) {
				selectorRules[rule.selector].push(rule.test);
			} else {
				selectorRules[rule.selector] = [rule.test];
			}

			let inputElements = formElement.querySelectorAll(rule.selector);

			Array.from(inputElements).forEach((inputElement) => {
				if (inputElement) {
					// ? Xử lý trường hợp blur khỏi input
					inputElement.onblur = function () {
						validate(inputElement, rule);
					};

					//? Xử lý mỗi khi người dùng nhập
					inputElement.oninput = function () {
						let errorElement = getParent(
							inputElement,
							options.formGroupSelector
						).querySelector(options.errorSelector);

						errorElement.innerText = "";
						inputElement.parentElement.classList.remove("invalid");
					};
				}
			});
		});
	}
}

// - Định nghĩa các rules
Validator.isRequired = function (selector, message) {
	return {
		selector,
		test(value) {
			return value ? undefined : message || "Vui lòng nhập trường này";
		},
	};
};
Validator.isEmail = function (selector, message) {
	return {
		selector,
		test(value) {
			return /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(value)
				? undefined
				: message || "Vui lòng nhập đúng định dạng email";
		},
	};
};

Validator.minLength = function (selector, min, message) {
	return {
		selector,
		test(value) {
			return value.length >= min
				? undefined
				: message || `Vui lòng nhập tối thiểu ${min} ký tự`;
		},
	};
};

Validator.isConfirmed = function (selector, getConfirmValue, message) {
	return {
		selector,
		test(value) {
			return value == getConfirmValue()
				? undefined
				: message || "Dữ liệu nhập vào không chính xác";
		},
	};
};

Validator.isSelected = function (selector, message) {
	return {
		selector,
		test(value) {
			return value.selectedIndex != 0
				? undefined
				: message || "Vui lòng lựa chọn";
		},
	};
};
