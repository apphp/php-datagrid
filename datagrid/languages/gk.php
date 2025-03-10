<?php
//------------------------------------------------------------------------------             
//*** Greek (gk)
//------------------------------------------------------------------------------
function setLanguageGk(){
    $lang['='] = "=";  // "equal";
    $lang['!='] = "!="; // "not equal"; 
    $lang['>'] = ">";  // "bigger";
    $lang['>='] = ">=";  // "bigger or equal";
    $lang['<'] = "<";  // "smaller";
    $lang['<='] = "<=";  // "smaller or equal";            
    $lang['add'] = "Προσθήκη";
    $lang['add_new'] = "+ Προσθήκη νέου";
    $lang['add_new_record'] = "Προσθήκη νέας εγγραφής";
    $lang['add_new_record_blocked'] = "Έλεγχος ασφαλείας: απόπειρα να προστεθεί ένα νέο ρεκόρ! Ελέγξτε τις ρυθμίσεις σας, η λειτουργία δεν επιτρέπεται!";
    $lang['adding_operation_completed'] = "Η λειτουργία προσθήκης ολοκληρώθηκε με επιτυχία!";
    $lang['adding_operation_uncompleted'] = "Η λειτουργία προσθήκης δεν ολοκληρώθηκε!";
    $lang['alert_perform_operation'] = "Είστε σίγουροι ότι θέλετε να εκτελέσετε αυτήν την πράξη;";
    $lang['alert_select_row'] = "Θα πρέπει να επιλέξετε μία ή περισσότερες σειρές για την εκτέλεση αυτής της λειτουργίας!";    
	$lang['alert_field_cannot_be_empty'] = 'Field {title} cannot be empty! Please re-enter.';
	$lang['alert_field_must_be_alphabetic'] = 'Field {title} must have alphabetic value! Please re-enter.';
	$lang['alert_field_must_be_float'] = 'Field {title} must be a float value! Please re-enter.';
	$lang['alert_field_must_be_integer'] = 'Field {title} must be an integer value! Please re-enter.';
    $lang['and'] = "και";
    $lang['any'] = "οποιοδήποτε";
    $lang['ascending'] = "Αύξουσα";
    $lang['back'] = "Επιστροφή";
    $lang['cancel'] = "Ακύρωση";
    $lang['cancel_creating_new_record'] = "Είστε σίγουροι ότι θέλετε να ακυρώσετε τη δημιουργία νέων καταχωρήσεων;";
    $lang['check_all'] = "Επιλογή όλων";
    $lang['clear'] = "Καθαρισμός";
    $lang['click_to_download'] = "Κάντε κλικ για να κατεβάσετε";
    $lang['clone_selected'] = "επέλέχθει Κλώνος";
    $lang['cloning_record_blocked'] = "Έλεγχος ασφαλείας: απόπειρα κλωνοποίησης εγγραφής! Ελέγξτε τις ρυθμίσεις σας, η λειτουργία δεν επιτρέπεται!";
    $lang['cloning_operation_completed'] = "Η λειτουργία κλωνοποίησης ολοκληρώθηκε με επιτυχία!";
    $lang['cloning_operation_uncompleted'] = "Η λειτουργία κλωνοποίησης απέτυχε!";
    $lang['create'] = "Δημιουργία";
    $lang['create_new_record'] = "Δημιουργία νέας εγγραφής";
    $lang['current'] = "τρέχουσες";
    $lang['delete'] = "Διαγραφή";
    $lang['delete_record'] = "Διαγραφή εγγραφής";
    $lang['delete_record_blocked'] = "Έλεγχος ασφαλείας: απόπειρα διαγραφής μιας εγγραφής! Ελέγξτε τις ρυθμίσεις σας, η λειτουργία δεν επιτρέπεται!";
    $lang['delete_selected'] = "Διαγραφή επιλεγμένων";
    $lang['delete_selected_records'] = "Είστε σίγουροι ότι θέλετε να διαγράψετε τα επιλεγμένα αρχεία;";
    $lang['delete_this_record'] = "Είστε σίγουροι ότι θέλετε να διαγράψετε αυτή την εγγραφή;";
    $lang['deleting_operation_completed'] = "Η λειτουργία διαγραφής ολοκληρώθηκε με επιτυχία!";
    $lang['deleting_operation_uncompleted'] = "Η λειτουργία διαγραφής απέτυχε!";
    $lang['descending'] = "Φθίνουσα";
    $lang['details'] = "Λεπτομέρειες";
    $lang['details_selected'] = "Προβολή επιλεγμένων";
    $lang['download'] = "Λήψη";    
    $lang['edit'] = "Επεξεργασία";
    $lang['edit_selected'] = "Επεξεργασία επιλεγμένων";
    $lang['edit_record'] = "Επεξεργασία εγγραφής";
    $lang['edit_selected_records'] = "Είστε σίγουροι ότι θέλετε να επεξεργαστείτε τις επιλεγμένες εγγραφές;";
    $lang['errors'] = "Λάθη";
	$lang['exchange_operation_completed'] = "The exchange columns operation on selected rows completed successfully!";
	$lang['exchange_operation_uncompleted'] = "The exchange columns operation on selected rows uncompleted!";
	$lang['exchange_selected'] = "Exchange columns in selected rows";
    $lang['export_to_excel'] = "Εξαγωγή στο Excel";
    $lang['export_to_pdf'] = "Εξαγωγή στο PDF";
    $lang['export_to_word'] = "Εξαγωγή στο Word";
    $lang['export_to_xml'] = "Εξαγωγή στο XML";
    $lang['export_message'] = "<label class=\"default_dg_label\">Το _FILE_ αρχείο είναι έτοιμο. Αφού τελειώσετε το κατέβασμα,</label> <a class=\"default_dg_error_message\" href=\"javascript:window.close();\">κλείσετε αυτό το παράθυρο</a>.";
    $lang['field'] = "Πεδίο";
    $lang['field_value'] = "Αξία πεδίου";
    $lang['file_find_error'] = "Δεν μπορεί να βρεθεί το αρχείο: <b>_FILE_</b>. Ελέγξτε αν το αρχείο αυτό υπάρχει και χρησιμοποιείστε τη σωστή διαδρομή!";
    $lang['file_opening_error'] = "Δεν μπορώ να ανοίξω ένα αρχείο. Ελέγξτε τα δικαιώματά σας.";
    $lang['file_extension_error'] = "Αποστολή αρχείων σφάλμα: επέκταση αρχείου που δεν επιτρέπεται για upload. Επιλέξτε ένα άλλο αρχείο.";
    $lang['file_writing_error'] = "Δεν είναι δυνατή η εγγραφή στο αρχείο. Ελέγξτε δικαιώματα εγγραφής!";
    $lang['file_invalid_file_size'] = "μη επιτρεπτό μέγεθος αρχείου";
    $lang['file_uploading_error'] = "Υπήρξε ένα σφάλμα κατά τη μεταφόρτωση, παρακαλώ προσπαθήστε ξανά!";
    $lang['file_deleting_error'] = "Υπήρξε ένα σφάλμα κατά τη διαγραφή!";
    $lang['first'] = "πρώτη";
    $lang['format'] = "Μορφή";
    $lang['generate'] = "Δημιουργία";
    $lang['handle_selected_records'] = "Είστε σίγουροι ότι θέλετε να χειριστείτε τα επιλεγμένα αρχεία;";
    $lang['hide_search'] = "Απόκρυψη Αναζήτησης";
    $lang['item'] = "στοιχείο";
    $lang['items'] = "αντικείμενα";
    $lang['last'] = "τελευταία";
    $lang['like'] = "μοιάζει";
    $lang['like%'] = "Αρχίζει με";  // "begins with";
    $lang['%like'] = "Τελειώνει με";  // "ends with";
    $lang['%like%'] = "Περιέχει";
    $lang['loading_data'] = "φόρτωση δεδομένων ...";
    $lang['max'] = "max";
    $lang['max_number_of_records'] = "Έχετε υπερβεί το μέγιστο αριθμό των επιτρεπόμενων εγγραφών!";
    $lang['move_down'] = "Μετακίνηση κάτω";
    $lang['move_up'] = "Μετακίνηση επάνω";
    $lang['move_operation_completed'] = "Η λειτουργία μετακίνησης ολοκληρώθηκε με επιτυχία!";
    $lang['move_operation_uncompleted'] = "Η λειτουργία μετακίνησης σειράς ημιτελή!";        
    $lang['next'] = "επόμενη";
    $lang['no'] = "Δεν";                                
    $lang['no_data_found'] = "Δεν βρέθηκαν δεδομένα"; 
    $lang['no_data_found_error'] = "Δεν βρέθηκαν δεδομένα! Παρακαλούμε, ελέγξτε προσεκτικά τη σύνταξη κώδικα σας!<br>Κάντε Μπορεί να είναι Κεφαλαία /μικρά, ή να υπάρχουν κάποια μη επιτρεπτά σύμβολα.";                                
    $lang['no_image'] = "Δεν βρέθηκε εικόνα";
    $lang['not_like'] = "Δεν μοιάζει";
    $lang['of'] = "από";
    $lang['operation_was_already_done'] = "Η επιχείρηση είχε ήδη ολοκληρωθεί! Δεν μπορείτε να το επαναλάβετε ξανά.";            
    $lang['or'] = "ή";                
    $lang['pages'] = "Σελίδες";                    
    $lang['page_size'] = "Μέγεθος σελίδας"; 
    $lang['previous'] = "προηγούμενο";                
    $lang['printable_view'] = "Εκτυπώσιμη Προβολή";
    $lang['print_now'] = "Εκτυπώστε τώρα";
    $lang['print_now_title'] = "Κάντε κλικ εδώ για να εκτυπώσετε αυτή τη σελίδα";
    $lang['record_n'] = "# Εγγραφής";
    $lang['refresh_page'] = "Ανανέωση σελίδας";
    $lang['remove'] = "Κατάργηση";
    $lang['reset'] = "Επαναφορά";                        
    $lang['results'] = "Αποτελέσματα";
    $lang['required_fields_msg'] = "<span style='color:#cd0000'>*</span> Τα πεδία που σημειώνονται με αστερίσκο είναι υποχρεωτικά";
    $lang['search'] = "Αναζήτηση"; 
    $lang['search_d'] = "Αναζήτηση"; // (description) 
    $lang['search_type'] = "Αναζήτηση τύπου"; 
    $lang['select'] = "επιλέξτε";
    $lang['set_date'] = "Ορισμός ημερομηνίας";
    $lang['sort'] = "Ταξινόμηση";        
    $lang['test'] = "Δοκιμή";
    $lang['total'] = "Σύνολο";
    $lang['turn_on_debug_mode'] = "Για περισσότερες πληροφορίες, ενεργοποιήστε τη λειτουργία εντοπισμού σφαλμάτων.";
    $lang['uncheck_all'] = "Αποεπιλογή όλων";
    $lang['unhide_search'] = "Επανεμφάνιση αναζήτησης";
    $lang['unique_field_error'] = "Το _FIELD_ πεδίο επιτρέπει μόνο μοναδικές τιμές - παρακαλώ ξαναγράψτε!";            
    $lang['update'] = "Ενημέρωση"; 
    $lang['update_record'] = "Ενημέρωση εγγραφής";
    $lang['update_record_blocked'] = "Έλεγχος ασφαλείας: προσπάθεια ενημέρωσης της εγγραφής! Ελέγξτε τις ρυθμίσεις σας, η λειτουργία δεν επιτρέπεται!";    
    $lang['updating_operation_completed'] = "Η ενημέρωση ολοκληρώθηκε με επιτυχία!";
    $lang['updating_operation_uncompleted'] = "Η ενημέρωση δεν ολοκληρώθηκε!";                        
    $lang['upload'] = "Ανεβάστε";
    $lang['uploaded_file_not_image'] = "Το αρχείο δεν φαίνεται να είναι εικόνα.";
    $lang['view'] = "Προβολή"; 
    $lang['view_details'] = "Προβολή Λεπτομερειών";
    $lang['warnings'] = "Προειδοποιήσεις";            
    $lang['with_selected'] = "Με επιλεγμένο";
    $lang['wrong_field_name'] = "Λάθος όνομα του πεδίου";
    $lang['wrong_parameter_error'] = "Λάθος παράμετρος [<b>_FIELD_</b>]: _VALUE_";
    $lang['yes'] = "Ναι";                

    // date-time
    $lang['day']    = "ημέρα";
    $lang['month']  = "μήνα";
    $lang['year']   = "έτος";
    $lang['hour']   = "ώρα";
    $lang['min']    = "Λεπτό";
    $lang['sec']    = "Δευτερόλεπτο";
    $lang['months'][1] = "Ιανουάριος";
    $lang['months'][2] = "Φεβρουάριος";
    $lang['months'][3] = "Μάρτιος";
    $lang['months'][4] = "Απρίλιος";
    $lang['months'][5] = "Μάιος";
    $lang['months'][6] = "Ιούνιος";
    $lang['months'][7] = "Ιούλιος";
    $lang['months'][8] = "Αύγουστος";
    $lang['months'][9] = "Σεπτέμβριος";
    $lang['months'][10] = "Οκτώβριος";
    $lang['months'][11] = "Νοέμβριος";
    $lang['months'][12] = "Δεκέμβριος";
    
    return $lang;
}
