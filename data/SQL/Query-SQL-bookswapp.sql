##################################
#Bookswapp
###################################

#Elenco dei libri adottati da una scuola - anno
select * from bsw_book 
	inner join bsw_adoption on book_id = bsw_book.id
	where school_id = 1 
	and year_adoption = 2013

#Elenco dei libri in possesso di un utente per scuola, classe, anno
# dati di prova
# user 2 - classroom_id 16 - attended_year 2012 (user, 3ASIA, 2012)
# user 4 - classroom_id 16 - attended_year 2013 (alunno3asia, 3ASIA, 2013)
select * from bsw_book 
		inner join bsw_adoption on book_id = bsw_book.id
		inner join bsw_classroom on bsw_adoption.classroom_id = bsw_classroom.id
		inner join bsw_user_has_classroom on bsw_user_has_classroom.classroom_id = bsw_classroom.id
		where user_id=2
		and attended_year = 2012
		and bsw_adoption.classroom_id=16
	    and year_adoption = 2012
  