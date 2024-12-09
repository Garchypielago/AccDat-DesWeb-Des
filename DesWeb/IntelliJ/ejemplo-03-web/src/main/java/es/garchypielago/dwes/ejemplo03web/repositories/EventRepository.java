package es.garchypielago.dwes.ejemplo03web.repositories;

import es.garchypielago.dwes.ejemplo03web.Entities.Event;

import java.util.List;

public interface EventRepository {

    long count();
    List<Event> findAll();
    Event findById(long id);

}
