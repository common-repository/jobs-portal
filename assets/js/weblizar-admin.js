jQuery(document).ready(function($) {
	try {
		$("#post").validate();
	} catch (e) {}

	var weblizarJobSalary = $(".weblizar_job_salary");
	var weblizarJobSalaryValue = $(
		'input[name="weblizar_job_salary"]:checked'
	).val();
	if (weblizarJobSalaryValue == "range") {
		weblizarJobSalary.show();
	} else {
		weblizarJobSalary.hide();
	}
	$('input[name="weblizar_job_salary"]').on("change", function() {
		if (this.value == "range") {
			weblizarJobSalary.fadeIn();
		} else {
			weblizarJobSalary.fadeOut();
		}
	});

	var weblizarLastWorkingDay = $(".weblizar_last_working_day");
	var weblizarNoticePeriod = $(
		'select[name="candidate_work_experience_notice_period"]'
	).val();
	if (weblizarNoticePeriod == "current") {
		weblizarLastWorkingDay.show();
	} else {
		weblizarLastWorkingDay.hide();
	}
	$(
		'select[name="candidate_work_experience_notice_period"]'
	).on("change", function() {
		if (this.value == "current") {
			weblizarLastWorkingDay.fadeIn();
		} else {
			weblizarLastWorkingDay.fadeOut();
		}
	});

	try {
		var weblizarJobDepartments = $(
			"#weblizar_candidate_desired_job_departments"
		);
		var weblizarJobDepartmentsPlaceholder = weblizarJobDepartments.data(
			"placeholder"
		);
		weblizarJobDepartments.fSelect({
			placeholder: weblizarJobDepartmentsPlaceholder
		});

		var weblizarJobTypes = $("#weblizar_candidate_desired_job_types");
		var weblizarJobTypesPlaceholder = weblizarJobTypes.data("placeholder");
		weblizarJobTypes.fSelect({
			placeholder: weblizarJobTypesPlaceholder
		});
	} catch (e) {}

	$(
		document
	).on("click", "#weblizar_candidate_education_row_add_more", function() {
		$(".weblizar_candidate_education_row")
			.first()
			.clone()
			.find("input")
			.attr({ value: "" })
			.end()
			.appendTo("#weblizar_candidate_education_rows");
	});
	$(document).on("click", ".candidate_education_remove_label", function() {
		if ($(".weblizar_candidate_education_row").length > 1) {
			$(this).parent().parent().remove();
		}
	});

	$(
		document
	).on("click", "#weblizar_candidate_employment_row_add_more", function() {
		$(".weblizar_candidate_employment_row")
			.first()
			.clone()
			.find("input")
			.attr({ value: "" })
			.end()
			.appendTo("#weblizar_candidate_employment_rows");
	});
	$(document).on("click", ".candidate_employment_remove_label", function() {
		if ($(".weblizar_candidate_employment_row").length > 1) {
			$(this).parent().parent().remove();
		}
	});

	$(
		document
	).on("click", "#weblizar_candidate_certification_row_add_more", function() {
		$(".weblizar_candidate_certification_row")
			.first()
			.clone()
			.find("input")
			.attr({ value: "" })
			.end()
			.appendTo("#weblizar_candidate_certification_rows");
	});
	$(document).on("click", ".candidate_certification_remove_label", function() {
		if ($(".weblizar_candidate_certification_row").length > 1) {
			$(this).parent().parent().remove();
		}
	});

	$(
		document
	).on("click", "#weblizar_candidate_skills_row_add_more", function() {
		$(".weblizar_candidate_skills_row")
			.first()
			.clone()
			.find("input")
			.attr({ value: "" })
			.end()
			.appendTo("#weblizar_candidate_skills_rows");
	});
	$(document).on("click", ".candidate_skills_remove_label", function() {
		if ($(".weblizar_candidate_skills_row").length > 1) {
			$(this).parent().parent().remove();
		}
	});

	/* Copy target content to clipboard on click */
	function copyToClipboard(selector, target) {
		$(document).on("click", selector, function() {
			var value = $(target).text();
			var temp = $("<input>");
			$("body").append(temp);
			temp.val(value).select();
			document.execCommand("copy");
			temp.remove();
			toastr.success("Copied to clipboard.");
		});
	}

	copyToClipboard(
		"#weblizar_job_portal_shortcode_copy",
		"#weblizar_job_portal_shortcode"
	);
	copyToClipboard(
		"#weblizar_job_portal_account_shortcode_copy",
		"#weblizar_job_portal_account_shortcode"
	);
});