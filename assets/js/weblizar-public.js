jQuery(document).ready(function($) {
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

	try {
		var weblizarJobTypes = $("#weblizar_job_types");
		var weblizarJobTypesPlaceholder = weblizarJobTypes.data("placeholder");
		weblizarJobTypes.fSelect({
			placeholder: weblizarJobTypesPlaceholder
		});

		var weblizarJobIndustries = $("#weblizar_job_industries");
		var weblizarJobIndustriesPlaceholder = weblizarJobIndustries.data(
			"placeholder"
		);
		weblizarJobIndustries.fSelect({
			placeholder: weblizarJobIndustriesPlaceholder
		});

		var weblizarJobDepartments = $("#weblizar_job_departments");
		var weblizarJobDepartmentsPlaceholder = weblizarJobDepartments.data(
			"placeholder"
		);
		weblizarJobDepartments.fSelect({
			placeholder: weblizarJobDepartmentsPlaceholder
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

	var weblizarCVDelete = $(".weblizar-cv-delete");
	weblizarCVDelete.hide();
	$(document).on("click", ".weblizar-cv-more-options", function() {
		weblizarCVDelete.fadeToggle();
	});

	var weblizarCompanyDelete = $(".weblizar-company-delete");
	weblizarCompanyDelete.hide();
	$(document).on("click", ".weblizar-company-more-options", function() {
		weblizarCompanyDelete.fadeToggle();
	});

	var weblizarSignupHeading = $(".weblizar-signup-heading span");
	var weblizarSignupForm = $("#weblizar-signup-form");

	$(document).on("click", ".weblizar-signup-as-list a", function() {
		$(this).parent().parent().find("a").removeClass("active");
		$(this).addClass("active");
	});

	$(document).on("click", "#weblizar-signup-as-recruiter", function() {
		var heading = $(this).data("heading");
		weblizarSignupHeading.html(heading);
		weblizarSignupForm.find('input[name="signup_as"]').val("recruiter");
	});

	$(document).on("click", "#weblizar-signup-as-candidate", function() {
		var heading = $(this).data("heading");
		weblizarSignupHeading.html(heading);
		weblizarSignupForm.find('input[name="signup_as"]').val("candidate");
	});

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

	$(document).on("click", "#weblizar-change-password-email-button", function() {
		$(".weblizar-change-password-email").fadeToggle();
	});
});
