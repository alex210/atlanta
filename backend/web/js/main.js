$(function() {

	/* Authors */

	$('#formAuthor').on('beforeSubmit', function() {
		const form = $(this);
		$.ajax({
			type: 'POST',
			url: '/authors/create',
			data: form.serializeArray(),
			success: function(data) {
				if (data.validation) {
          form.yiiActiveForm('updateMessages', data.validation, true);
        } else {
        	resetForm(form, 'success', 'Автор успешно добавлен!');
        	$.pjax.reload({container:'#p0'});
        }
			},
			error: function() {
        	resetForm(form, 'error', 'Ошибка! Попробуйте позже.');
			}
		});

		return false;
	});

	function resetForm(form, alert, message) {
		form.find('input[name="Authors[name]"]').val('');
    form.find('input[name="Authors[surname]"]').val('');
    form.prepend(`<div class="alert alert-${alert}">${message}</div>`);
    setTimeout(function() {
    	form.find('.alert').remove();
    	$.magnificPopup.close();
    }, 1000);
	}

	$('body').on('click', '.deleteAuthor', function() {
		if( confirm('Вы уверены, что хотите удалить этого автора?') ) {
			$.ajax({
				type: 'GET',
				url: $(this).attr('href'),
				success: function() {
					$.pjax.reload({container:'#p0'});	
				},
				error: function() {
					$.pjax.reload({container:'#p0'});	
					alert('Ошибка! Попробуйте позже.');
				}
			});
		}

		return false;
	});

	$('body').on('click', '.updateAuthor', function() {
		$('#modalUpdateAuthor .wrapper').html('').load('/authors/update?id=' + $(this).attr('data-id'));
	});

		$('body').on('submit', '#modalUpdateAuthor form', function() {
			const form = $(this);
			$.ajax({
				type: 'POST',
				url: form.attr('action'),
				data: form.serializeArray(),
				success: function() {
					$.pjax.reload({container:'#p0'});
					$.magnificPopup.close();
				},
				error: function() {
					$.pjax.reload({container:'#p0'});	
					$.magnificPopup.close();
					alert('Ошибка! Попробуйте позже.');
				}
			});

		return false;
	});

	$('body').on('click', '.getJournals', function() {
		let th = $(this);

		if( th.find('+ .list-journal').length ) {		
			th.find('+ .list-journal').slideToggle(200);
		} else {
			$.ajax({
				type: 'GET',
				url: '/authors/get-journals?id=' + th.attr('data-id'),
				success: function(data) {
					data = JSON.parse(data);
					let html = '<ul class="list-group list-journal">';
					if(data.length == 0) {
						html += '<li class="list-group-item">Журналов не найдено</li>';
					} else {
						for(let journal of data) {
							html += `<li class="list-group-item">${journal.title} - ${journal.created_at}</li>`;
						}
					}
					html += '</ul>';
					th.after(html);
				}
			});
		}
				
	});

	/* Journals */

	$('#addJournal').click(function() {
		$('#modalCreateJournal .wrapper').html('').load('/journals/create');
	});

	$('body').on('submit', '#modalCreateJournal form', function() {
		const form = $(this);
		ajaxJournal(form);

		return false;
	});

	$('body').on('click', '.deleteJournal', function() {
		if( confirm('Вы уверены, что хотите удалить этот журнал?') ) {
			$.ajax({
				type: 'GET',
				url: $(this).attr('href'),
				success: function() {
					$.pjax.reload({container:'#p0'});	
				},
				error: function() {
					$.pjax.reload({container:'#p0'});	
					alert('Ошибка! Попробуйте позже.');
				}
			});
		}

		return false;
	});

	$('body').on('click', '.updateJournal', function() {
		$('#modalUpdateJournal .wrapper').html('').load('/journals/update?id=' + $(this).attr('data-id'));
	});

	$('body').on('submit', '#modalUpdateJournal form', function() {
		const form = $(this);
		ajaxJournal(form);
		return false;
	});


	function ajaxJournal(form) {
		let fd = new FormData();

		if($('input[name="Journals[file]"]')[1].files[0]) {
			fd.append('file', $('input[name="Journals[file]"]')[1].files[0]);
		}

		let data = $(form).serializeArray();
		$.each(data, function(key, input){
			fd.append(input.name,input.value);
		});

		$.ajax({
			type: 'POST',
			url: form.attr('action'),
			data: fd,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data) {
				data = JSON.parse(data);
				if(data.error) {
					alert(data.error);
				}
				$.pjax.reload({container:'#p0'});
				$.magnificPopup.close();
			},
			error: function() {
				$.pjax.reload({container:'#p0'});	
				$.magnificPopup.close();
			}
		});
	}



});