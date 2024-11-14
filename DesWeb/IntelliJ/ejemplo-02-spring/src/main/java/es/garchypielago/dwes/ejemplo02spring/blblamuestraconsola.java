package es.garchypielago.dwes.ejemplo02spring;

import org.springframework.boot.CommandLineRunner;
import org.springframework.stereotype.Component;

@Component
public class blblamuestraconsola implements CommandLineRunner {
    @Override
    public void run(String... args) throws Exception {
        System.out.println("Eeeeeeyyy que pasa chavales");
    }
}
