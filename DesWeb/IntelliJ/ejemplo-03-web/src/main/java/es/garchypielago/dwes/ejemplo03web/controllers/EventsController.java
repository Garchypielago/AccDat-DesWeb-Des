package es.garchypielago.dwes.ejemplo03web.controllers;

import jakarta.servlet.http.HttpServletRequest;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

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
    public String getAllEvents() {
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
    public String getEventDetails(@PathVariable int eventId){
        System.out.println("Event id: "+eventId);

        return "event-details";
    }

}
