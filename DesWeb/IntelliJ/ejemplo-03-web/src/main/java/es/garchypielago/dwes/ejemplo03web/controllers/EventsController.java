package es.garchypielago.dwes.ejemplo03web.controllers;

import es.garchypielago.dwes.ejemplo03web.Entities.Event;
import es.garchypielago.dwes.ejemplo03web.repositories.base.Repository;
import es.garchypielago.dwes.ejemplo03web.repositories.base.RepositoryImp;
import jakarta.servlet.http.HttpServletRequest;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.servlet.ModelAndView;

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
    public ModelAndView getAllEvents() {
        List<Event> events = new ArrayList<>();
        events.add(new Event(1,"Evento1", "sisi", LocalDate.now(), LocalDate.now()));
        events.add(new Event(2,"Evento2", "siso", LocalDate.now(), LocalDate.now()));
        events.add(new Event(3,"Evento3", "soso", LocalDate.now(), LocalDate.now()));

        ModelAndView modelAndView = new ModelAndView("event-list", "events", events);
        modelAndView.addObject("usuario", "ElParras");
        return modelAndView;
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
    public String getEventDetails(@ModelAttribute(name = "eventId") @PathVariable int eventId, Model model) {
        System.out.println("Event id: "+eventId);

//        Event event = new Event(1,"Cena SXM","Borrachos", LocalDate.now().plusDays(21), LocalDate.now().plusDays(22) );
        Event event = new Event(1,"Cena SXM","Borrachos", LocalDate.now().plusDays(21), null );

        model.addAttribute("eventId", eventId).addAttribute("event", event).addAttribute("Otra cosa", "Otras cosas");

        return "event-details";
    }

    @ModelAttribute(name="languages")
    private Iterable<String> getLanguages(){
        List<String> languages = new ArrayList<>();
        languages.add("es");
        languages.add("de");
        languages.add("it");
        return languages;
    }

    private void pruebas(){
        Repository<Event, Integer> repo = new RepositoryImp<>();

        Event e = repo.findById(4);
    }
}
