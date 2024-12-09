package es.garchypielago.dwes.ejemplo03web.repositories;

import es.garchypielago.dwes.ejemplo03web.Entities.Event;

import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.stream.Collectors;

public class EventRepositoryImpl implements EventRepository {
    private Map<Long, Event> events = new HashMap<>();

    @Override
    public long count() {
        return 0;
    }

    @Override
    public List<Event> findAll() {
        return events.values();
    }

    @Override
    public Event findById(long id) {
        return null;
    }
}
