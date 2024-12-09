package es.garchypielago.dwes.ejemplo03web.Entities;

import lombok.*;

import java.time.LocalDate;

@Getter
@AllArgsConstructor
@NoArgsConstructor
@Setter(AccessLevel.PRIVATE)
@ToString
@EqualsAndHashCode
public class Event {

    private int eventId;
    private String title,  description;
    private LocalDate start, end;

//    @Setter(AccessLevel.PRIVATE) esta pone privado el acceso
//    @Setter(AccessLevel.NONE) esta elimina el param de los setter

}
