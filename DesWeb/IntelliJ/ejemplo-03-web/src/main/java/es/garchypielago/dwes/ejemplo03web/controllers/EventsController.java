package es.garchypielago.dwes.ejemplo03web.controllers;

import es.garchypielago.dwes.ejemplo03web.model.Event;
import jakarta.servlet.http.HttpServletRequest;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;

@Controller
@RequestMapping("/event")
public class EventsController {

//    @RequestMapping("/index.html")
//    public String doSomething() {
//        System.out.println("Estoy en el controlador");
//        return "hola";
//    }

//    mapping que solo admite request get
//    @RequestMapping(value = "", method = RequestMethod.GET)
    @GetMapping({"", "/"})
    public String getAllEvents(Model model) {
        List<Event> events = new ArrayList<>();
        events.add(new Event(1,"Evento1", "sisi", LocalDate.of(2020, 1, 1), LocalDate.of(2020, 1, 2)));
        events.add(new Event(1,"Evento2", "siso", LocalDate.of(2020, 1, 1), LocalDate.of(2020, 1, 2)));
        events.add(new Event(1,"Evento3", "soso", LocalDate.of(2020, 1, 1), LocalDate.of(2020, 1, 2)));

        model.addAttribute("events", events);

        return "event-list";
    }

    @GetMapping("/new")
//    @RequestMapping("/new")
    public String getCreateForm(HttpServletRequest request) {
        return "new-event";
    }

    @PostMapping("/new")
    public String createEvent() {
        return "event-create";
    }

//    aun que lo pongas encima del new, sigue pillando el new con prioridad
//    mejor usar el mismo nombre de dato de entrad que el dato de la url
    @GetMapping("/{eventId}")
    public String getEventDetails(@PathVariable int eventId, Model model) {
        System.out.println("Event id: "+eventId);

//        Event event = new Event(1,"Cena SXM","Borrachos", LocalDate.now().plusDays(21), LocalDate.now().plusDays(22) );
        Event event = new Event(1,"Cena SXM","Borrachos", LocalDate.now().plusDays(21), null );

        model.addAttribute("eventId", eventId).addAttribute("event", event).addAttribute("Otra cosa", "Otras cosas");

        return "event-details";
    }

}
