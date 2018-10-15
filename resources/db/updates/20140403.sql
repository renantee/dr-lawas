ALTER TABLE `drlawas`.`patient_details`
ADD INDEX `patient_id` (`patient_id`);

ALTER TABLE `drlawas`.`patient_medicine`
ADD INDEX `patient_medicine` (`patient_detail_id` ,`medicine_id`);