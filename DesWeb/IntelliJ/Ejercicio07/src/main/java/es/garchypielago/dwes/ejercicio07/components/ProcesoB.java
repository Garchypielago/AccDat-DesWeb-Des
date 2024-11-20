package es.garchypielago.dwes.ejercicio07.components;

import es.garchypielago.dwes.ejercicio07.beans.Contador;
import net.datafaker.Faker;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.boot.CommandLineRunner;
import org.springframework.core.annotation.Order;
import org.springframework.stereotype.Component;
import es.garchypielago.dwes.ejercicio07.servicies.MessageService;


@Component
@Order(2)
public class ProcesoB implements CommandLineRunner {

    private final MessageService messageService;
    private final Faker faker;
    private final Contador contador;

    public ProcesoB(
            @Qualifier("systemOutMessageService")
            MessageService messageService, Faker faker, Contador contador) {
        this.messageService = messageService;
        this.faker = faker;
        this.contador = contador;
    }

    @Override
    public void run(String... args) throws Exception {
        messageService.showMessage("Proceso B");
        System.out.println(faker.bigBangTheory().quote());
        contador.sumar();
        System.out.println("PB"+contador.getNumero());
        contador.sumar();
        System.out.println("PB"+contador.getNumero());
        contador.sumar();
        System.out.println("PB"+contador.getNumero());
    }
}
