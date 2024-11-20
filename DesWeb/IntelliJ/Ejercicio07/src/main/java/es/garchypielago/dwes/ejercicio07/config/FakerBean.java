package es.garchypielago.dwes.ejercicio07.config;

import net.datafaker.Faker;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;

@Configuration
public class FakerBean {
    @Bean
    public Faker fakerPrueba() {
        return new Faker();
    }
}
