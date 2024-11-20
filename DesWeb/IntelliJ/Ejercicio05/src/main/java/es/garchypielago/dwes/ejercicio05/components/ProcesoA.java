package es.garchypielago.dwes.ejercicio05.components;

import org.springframework.boot.CommandLineRunner;
import org.springframework.core.annotation.Order;
import org.springframework.stereotype.Component;
import es.garchypielago.dwes.ejercicio05.servicies.MessageService;


@Component
@Order(1)
public class ProcesoA implements CommandLineRunner {

    private final MessageService messageService;

    public ProcesoA(MessageService messageService) {
        this.messageService = messageService;
    }

    @Override
    public void run(String... args) throws Exception {
        messageService.showMessage("Proceso A");
    }
}
