package es.garchypielago.dwes.ejercicio06.components;

import org.springframework.boot.CommandLineRunner;
import org.springframework.core.annotation.Order;
import org.springframework.stereotype.Component;
import es.garchypielago.dwes.ejercicio06.servicies.MessageService;


@Component
@Order(2)
public class ProcesoB implements CommandLineRunner {
    private final MessageService messageService;

    public ProcesoB(MessageService messageService) {
        this.messageService = messageService;
    }

    @Override
    public void run(String... args) throws Exception {
        messageService.showMessage("Proceso B");
    }
}
