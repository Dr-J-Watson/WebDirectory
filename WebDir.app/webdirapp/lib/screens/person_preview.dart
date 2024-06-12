import 'package:flutter/material.dart';
import 'package:webdirapp/models/person.dart';
import 'package:webdirapp/screens/person_provider.dart';
import 'package:webdirapp/screens/person_details.dart';

class PersonPreview extends StatefulWidget {
  final Person person;
  final PersonProvider personProvider;

  PersonPreview({required this.person, required this.personProvider});

  @override
  _PersonPreviewState createState() => _PersonPreviewState();
}

class _PersonPreviewState extends State<PersonPreview> {
  @override
  Widget build(BuildContext context) {
    return GestureDetector(
    child: ListTile(
      leading: CircleAvatar(
        backgroundImage: widget.person.image != null
            ? NetworkImage(widget.person.image!)
            : null,
        child: widget.person.image == null
            ? Text(widget.person.firstName[0] + widget.person.lastName[0])
            : null,
      ),
      title: Text('${widget.person.firstName} ${widget.person.lastName}'),
      subtitle: Text(widget.person.numBureau),
      shape: const Border(bottom: BorderSide(color: Colors.grey)),
    ),
    onTap: () {
      Navigator.push(
        context,
        MaterialPageRoute(
          builder: (context) => PersonDetails(person: widget.person),
        ),
      );
    },
    
    );
  }
}

