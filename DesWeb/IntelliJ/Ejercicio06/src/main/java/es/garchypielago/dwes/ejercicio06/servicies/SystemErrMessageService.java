package es.garchypielago.dwes.ejercicio06.servicies;

import org.springframework.context.annotation.Primary;
import org.springframework.stereotype.Component;

@Component
@Primary
public class SystemErrMessageService implements MessageService {

    @Override
    public void showMessage(String message) {
        System.err.println(message);
    }
}
